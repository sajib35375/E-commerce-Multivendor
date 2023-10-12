<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\District;
use App\Models\Division;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\State;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

       $requestData = (array) json_decode($request->cart_json);

        //dd($requestData);

        $division = Division::where('id', $requestData['division_id'])->first();
        $district = District::where('id', $requestData['district_id'])->first();
        $state = State::where('id', $requestData['state_id'])->first();

        // dd($request['division_id']); return ;

        $post_data = array();
        $post_data['total_amount'] = $requestData['amount']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $requestData['cus_name'];
        $post_data['cus_email'] = $requestData['cus_email'];
        $post_data['cus_add1'] = $requestData['additional_information'];
        $post_data['cus_address'] = $requestData['cus_address'];
        $post_data['cus_city'] = $division->division_name;
        $post_data['cus_state'] = $state->state_name;
        $post_data['cus_postcode'] = $requestData['post_code'];
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $requestData['cus_phone'];
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $requestData['cus_name'];
        $post_data['ship_add1'] = $requestData['additional_information'];
        $post_data['ship_add2'] = $district->district_name;
        $post_data['ship_city'] = $division->division_name;
        $post_data['ship_state'] = $state->state_name;
        $post_data['ship_postcode'] = $requestData['post_code'];
        $post_data['ship_phone'] = $requestData['cus_phone'];
        $post_data['ship_country'] = "Bangladesh";

        // Customer
        $post_data['user_id'] = Auth::id();
        $post_data['division_id'] = $requestData['division_id'];
        $post_data['district_id'] = $requestData['district_id'];
        $post_data['state_id'] = $requestData['state_id'];
        $post_data['additional_information'] = $requestData['additional_information'];
        $post_data['payment_type'] = "SSLCommerz";
        $post_data['payment_method'] = "SSL Payment";
        $post_data['order_number'] = mt_rand(1000000000, 9999999999);
        $post_data['invoice_no'] = 'MVE'.mt_rand(10000000, 99999999);

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";



        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'user_id' => $post_data['user_id'],
                'division_id' => $post_data['division_id'],
                'district_id' => $post_data['district_id'],
                'state_id' => $post_data['state_id'],
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'post_code' => $post_data['cus_postcode'],
                'notes' => $post_data['additional_information'],
                'address' => $post_data['cus_address'],
                'payment_type' => $post_data['payment_type'],
                'payment_method' => $post_data['payment_method'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'amount' => $post_data['total_amount'],
                'order_number' => $post_data['order_number'],
                'invoice_number' => $post_data['invoice_no'],
                'order_date' => Carbon::now()->format('Y-m-d'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'pending',
                'created_at' => Carbon::now()
            ]);

        // find last order id
        $order_id = \Illuminate\Support\Facades\DB::getPdo()->lastInsertId();

        // find last order details
        $mailData = Order::find($order_id);
        $data = [
            'name' => $mailData->name,
            'email' => $mailData->email,
            'amount' => $mailData->amount,
            'order_date' => $mailData->order_date,
            'invoice_number' => $mailData->invoice_number,
            'payment_method' => $mailData->payment_method,
        ];

        Mail::to($mailData->email)->send(new OrderMail($data));

        $carts = Cart::content();

        foreach($carts as $cart){
            if ($cart->options->vendor_id){
                $vendor_id = $cart->options->vendor_id;
            }else{
                $vendor_id = NULL;
            }
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $vendor_id,
                'size' => $cart->options->size,
                'color' => $cart->options->color,
                'quantity' => $cart->qty,
                'price' => $cart->price,
            ]);
        }

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

        if (Cache::has('coupon')){
            Cache::forget('coupon');
        }

        Cart::destroy();

        Cache::forget('charge');

    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'pending']);

                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'pending']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'processing' || $order_details->status == 'complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
