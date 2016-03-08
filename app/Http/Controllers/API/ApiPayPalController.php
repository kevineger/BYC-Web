<?php

namespace App\Http\Controllers\API;

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

class ApiPayPalController extends Controller {

    private $api_context;
    private $user;

    public function __construct(ApiUsersController $apiUsersController)
    {
        $this->middleware('jwt.auth');
        $this->middleware('jwt.refresh');
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->api_context->setConfig($paypal_conf['settings']);

        $this->user = $apiUsersController->getAuthenticatedUser();
    }

    /**
     * Given post params, enter payment history in DB.
     *
     * @param Request $request
     */
    public function getPaymentStatus(Request $request)
    {
        // Get the payment information from the json post and persist the payment info in the DB
        $this->storeRecord($request);
    }

    /**
     * Persist a payment record in the database.
     *
     * @param Request $request
     * @internal param Payment $result
     */
    private function storeRecord(Request $request)
    {
        // Retrieve the posted json
        $payment_info = $request->all();

        $paypal_id = $payment_info['payments']['paypal_id'];
        $total = $payment_info['payments']['sum'];

        // Create the payment
        $payment = $this->user->payments()->create(['paypal_id' => $paypal_id, 'total' => $total]);

        // Add each of the purchases for the payment (items)
        foreach ( $payment_info['purchases'] as $purchase ) {
            $course = Course::find($purchase['course_id']);
            $time = Time::find($purchase['time_id']);
            $subtotal = $purchase['subtotal'];
            $quantity = $purchase['quantity'];

            $payment->purchases()->create([
                'course_id' => $course->id,
                'time_id'   => $time->id,
                'quantity'  => $quantity,
                'subtotal'  => $subtotal
            ]);
        }
    }

}