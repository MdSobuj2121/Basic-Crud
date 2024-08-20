<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Library\SslCommerz\SslCommerzNotification;

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
        $post_data = array();
        $post_data['total_amount'] = '10'; // You cannot pay less than 10 BDT
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // Transaction ID must be unique

        // CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_phone'] = '8801XXXXXXXXX';

        // SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        try {
            // Save order information as pending
            Order::updateOrCreate(
                ['transaction_id' => $post_data['tran_id']],
                [
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'status' => 'Pending',
                    'address' => $post_data['cus_add1'],
                    'currency' => $post_data['currency']
                ]
            );

            // Initiate payment with SSLCOMMERZ
            $sslc = new SslCommerzNotification();
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
            }
        } catch (\Exception $e) {
            Log::error('Payment initiation error: ' . $e->getMessage());
            return response()->json(['error' => 'Payment initiation failed.'], 500);
        }
    }

    public function payViaAjax(Request $request)
    {
        $post_data = array();
        $post_data['total_amount'] = '10'; // You cannot pay less than 10 BDT
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // Transaction ID must be unique

        // CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_phone'] = '8801XXXXXXXXX';

        // SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_country'] = "Bangladesh";

        try {
            // Save order information as pending
            Order::updateOrCreate(
                ['transaction_id' => $post_data['tran_id']],
                [
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'status' => 'Pending',
                    'address' => $post_data['cus_add1'],
                    'currency' => $post_data['currency']
                ]
            );

            // Initiate payment with SSLCOMMERZ via Ajax
            $sslc = new SslCommerzNotification();
            $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

            if (!is_array($payment_options)) {
                print_r($payment_options);
            }
        } catch (\Exception $e) {
            Log::error('Payment initiation error: ' . $e->getMessage());
            return response()->json(['error' => 'Payment initiation failed.'], 500);
        }
    }

    public function success(Request $request)
{
    $tran_id = $request->input('tran_id');
    $amount = $request->input('amount');
    $currency = $request->input('currency');

    $sslc = new SslCommerzNotification();

    try {
        // Check order status
        $order_details = Order::where('transaction_id', $tran_id)->first();

        if ($order_details && $order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
            if ($validation) {
                Order::where('transaction_id', $tran_id)->update(['status' => 'Processing']);

                // Get the course information to display
                $course = Course::find($order_details->course_id);

                return view('enrollments.success', ['course' => $course, 'message' => 'Transaction is successfully completed']);
            }
        } elseif ($order_details && ($order_details->status == 'Processing' || $order_details->status == 'Complete')) {
            return view('enrollments.success', ['message' => 'Transaction is already completed']);
        } else {
            return view('enrollments.success', ['message' => 'Invalid Transaction']);
        }
    } catch (\Exception $e) {
        Log::error('Transaction success handling error: ' . $e->getMessage());
        return response()->json(['error' => 'Transaction processing failed.'], 500);
    }
}

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        try {
            $order_details = Order::where('transaction_id', $tran_id)->first();

            if ($order_details && $order_details->status == 'Pending') {
                Order::where('transaction_id', $tran_id)->update(['status' => 'Failed']);
                echo "Transaction has Failed";
            } elseif ($order_details && ($order_details->status == 'Processing' || $order_details->status == 'Complete')) {
                echo "Transaction is already Completed";
            } else {
                echo "Invalid Transaction";
            }
        } catch (\Exception $e) {
            Log::error('Transaction fail handling error: ' . $e->getMessage());
            return response()->json(['error' => 'Transaction failure handling failed.'], 500);
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        try {
            $order_details = Order::where('transaction_id', $tran_id)->first();

            if ($order_details && $order_details->status == 'Pending') {
                Order::where('transaction_id', $tran_id)->update(['status' => 'Canceled']);
                echo "Transaction has been Canceled";
            } elseif ($order_details && ($order_details->status == 'Processing' || $order_details->status == 'Complete')) {
                echo "Transaction is already Completed";
            } else {
                echo "Invalid Transaction";
            }
        } catch (\Exception $e) {
            Log::error('Transaction cancel handling error: ' . $e->getMessage());
            return response()->json(['error' => 'Transaction cancellation handling failed.'], 500);
        }
    }

    public function ipn(Request $request)
    {
        if ($request->input('tran_id')) {
            $tran_id = $request->input('tran_id');

            try {
                $order_details = Order::where('transaction_id', $tran_id)->first();

                if ($order_details && $order_details->status == 'Pending') {
                    $sslc = new SslCommerzNotification();
                    $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                    if ($validation) {
                        Order::where('transaction_id', $tran_id)->update(['status' => 'Processing']);
                        echo "Transaction is successfully Completed";
                    }
                } elseif ($order_details && ($order_details->status == 'Processing' || $order_details->status == 'Complete')) {
                    echo "Transaction is already Completed";
                } else {
                    echo "Invalid Transaction";
                }
            } catch (\Exception $e) {
                Log::error('IPN handling error: ' . $e->getMessage());
                return response()->json(['error' => 'IPN processing failed.'], 500);
            }
        } else {
            echo "Invalid Data";
        }
    }
}
