<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Set currency, quantity and price (per unit) of each item
        $item_1 = new Item();
        $item_1->setName('Item 1')// item name
        ->setCurrency('USD')
            ->setQuantity(2)
            ->setPrice('15'); // unit price

        // Build array of items
        $items = [];
        $items[] = $item_1;

        // Add items to list
        $item_list = new ItemList();
        $item_list->setItems($items);

        // Set total
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(30);

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

        try
        {
            $payment->create($this->api_context);
        } catch (PayPalConnectionException $ex)
        {
            if (Config::get('app.debug'))
            {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else
            {
                die('There has been an error processing your payment on PayPal.');
            }
        }

        foreach ($payment->getLinks() as $link)
        {
            if ($link->getRel() == 'approval_url')
            {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url))
        {
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

        if (!$request->has('PayerID') || !$request->has('token'))
        {
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

        if ($result->getState() == 'approved')
        {
            error_log("Payment has been made");

            // Payment made
            return Redirect::route('original.route')
                ->with('success', 'Payment success');
        }

        error_log("Payment could not be made");

        return Redirect::route('original.route')
            ->with('error', 'Payment failed');
    }
}
