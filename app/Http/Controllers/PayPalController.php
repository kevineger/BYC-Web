<?php

namespace App\Http\Controllers;

use App\Course;
use App\Time;
use Auth;
use Carbon\Carbon;
use Cart;
use Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Redirect;
use Session;
use URL;

class PayPalController extends Controller {

    private $api_context;

    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment()
    {
        // Get the cart content
        $content = Cart::content();

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Build array of items from the cart content
        $items = [];
        $total = 0;
        foreach ( $content as $row ) {
            // Set currency, quantity and price (per unit) of each item
            // Note: Using Sku for course id
            $item = new Item();
            $item->setSku($row->id . '-' . $row->options->time_id)// Use compound course_id/time_id as sku
            ->setName($row->name)
                ->setCurrency('HKD')
                ->setQuantity($row->qty)
                ->setPrice($row->price); // unit price
            $total += $row->price * $row->qty;
            $items[] = $item;
        }

        // Add items to list
        $item_list = new ItemList();
        $item_list->setItems($items);

        // Set total
        $amount = new Amount();
        $amount->setCurrency('HKD')
            ->setTotal($total);

        // Create the transaction (amount, items and description)
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription("This is a payment of $amount for " . implode(", ", $items));

        // Set the redirect URL (upon making payment, where the user goes)
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
            ->setCancelUrl(URL::route('payment.status'));

        // Set the payment
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->api_context);
        } catch ( PayPalConnectionException $ex ) {
            dd($ex); // Debugging purposes
            if ( Config::get('app.debug') ) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('There has been an error processing your payment on PayPal.');
            }
        }

        foreach ( $payment->getLinks() as $link ) {
            if ( $link->getRel() == 'approval_url' ) {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());

        if ( isset($redirect_url) ) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        // TODO: Set up UI friendly route
        return Redirect::route('original.route')
            ->with('error', 'Unknown error occurred');
    }

    public function getPaymentStatus(Request $request)
    {
        error_log("Getting payment status");

        // Get the payment ID
        $payment_id = Session::get('paypal_payment_id');
        // Clear the session payment ID
        Session::forget('paypal_payment_id');

        if ( !$request->has('PayerID') || !$request->has('token') ) {
            // TODO: Set up UI friendly route
            return Redirect::route('original.route')
                ->with('error', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));

        // Execute the payment
        $result = $payment->execute($execution, $this->api_context);

        if ( $result->getState() == 'approved' ) {
            // Store payment result/record in DB
            $this->storeRecord($result);

            error_log("Payment has been made");

            // Payment made
            return Redirect::route('original.route')
                ->with('success', 'Payment success');
        }

        error_log("Payment could not be made");

        return Redirect::route('original.route')
            ->with('error', 'Payment failed');
    }

    /**
     * Persist a payment record in the database.
     *
     * @param Payment $result
     */
    private function storeRecord(Payment $result)
    {
        $paypal_id = $result->id;
        $total = $result->transactions[0]->amount->total;

        // Create and assign a payment to the user
        $payment = Auth::user()->payments()->create(['paypal_id' => $paypal_id, 'total' => $total]);

        // Add each of the purchases for the payment (items)
        foreach ( $result->transactions[0]->item_list->items as $item ) {
            // The SKU sent to paypal is compounded with course_id/time_id
            // TODO: Is there a better way to do this?
            $course = Course::findOrFail(explode('-', $item->sku)[0]);
            $time = $course->times()->where('time_id', explode('-', $item->sku)[1])->first();
            $quantity = $item->quantity;
            $subtotal = $quantity * $item->price;

            $payment->purchases()->create([
                'course_id' => $course->id,
                'time_id'   => $time->id,
                'quantity'  => $quantity,
                'subtotal'  => $subtotal
            ]);

            // Increase the number of registered seats
            $time->pivot->num_reg++;

            return "Payment successful.";
        }

    }
}
