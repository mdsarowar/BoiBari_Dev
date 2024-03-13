<?php

namespace App\Http\Controllers;
use App\FailedTranscations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
//use Karim007\LaravelBkash\Facade\BkashPayment;
//use Karim007\LaravelBkash\Facade\BkashRefund;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }

    public function createPayment(Request $request)
    {
//return $request;
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] =  round(Crypt::decrypt($request->amount), 2);
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");
//        return $request;

        $request_data_json = json_encode($request->all());

        $response =  BkashPaymentTokenize::cPayment($request_data_json);
//        return $response;
        if (isset($response['bkashURL'])){
            return redirect()->away($response['bkashURL']);
        }
        else {
            return redirect()->back()->with('error-alert2', $response['statusMessage']) ;
        }
    }

    public function callBack(Request $request)
    {
//        return "saorar";
        if ($request->status == 'success'){
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            if (!$response){ //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }
//            dd(json_encode($response));

//            return session()->all();
//            return $response;
            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
//                return $request;/
                $txn_id = $response['trxID'];

                $payment_method = 'Bkash Gateway';

                $payment_status = 'yes';
                $order_id=$response['customerMsisdn'].date("h:i:sa");

//                return $order_id;

                $checkout = new PlaceOrderController();

                return $checkout->placeorder($txn_id, $payment_method,$order_id, $payment_status);
//                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            notify()->error($response['statusMessage']);
            $failedTranscations = new FailedTranscations();
            $failedTranscations->txn_id = 'Bkash' . Str::uuid();
            $failedTranscations->user_id = auth()->id();
            $failedTranscations->save();
            return redirect(route('order.review'));
//            return BkashPaymentTokenize::failure($response['statusMessage']);
        }else if ($request->status == 'cancel'){
            notify()->error($request->status);
            return redirect(route('order.review'));
//            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            notify()->error($request->status);
            return redirect(route('order.review'));
//            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        $amount=5;
        $reason='this is test reason';
        $sku='abc';
        //response
        return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
