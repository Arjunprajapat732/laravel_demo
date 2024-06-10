<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('account.payments.index');
    }

    public function payment_form()
    {
        return view('account.payments.payment_form');
    }

    public function checkout(){
        return view('checkout');
        }

    public function payment(Request $request){
           $googlePay = json_decode($request['data']['paymentMethodData']['tokenizationData']['token'], true);
           $order = new Order;
           $order->user_id = auth()->user()->id;
           $order->amount = $request->amount;
           $order->discount = 0;
           $order->status = 1;
         if($order->save()){
               $transactions = new Transaction;
               $transactions->order_id = $order->id;
               $transactions->transaction_id = $googlePay['id'];
               $transactions->type = $request['data']['paymentMethodData']['tokenizationData']['type'] ?? '';
               $transactions->type = 1;
               $transactions->save();
                return response(['success' => true, 'url' => 'success']);
        }else{
               return response(['success' => false]);
       }
    }

    public function processpayment_square(Request $request)
    {
        dd($request->all());
        $client = new SquareClient([
            'accessToken' => 'YOUR_ACCESS_TOKEN',
            'environment' => Environment::SANDBOX,
        ]);

        $paymentsApi = $client->getPaymentsApi();

        $body = new CreatePaymentRequest([
            'source_id' => $request->input('nonce'), // Square payment token
            'amount_money' => ['amount' => 100, 'currency' => 'USD'], // Example amount
            'idempotency_key' => uniqid(),
        ]);

        try {
            $result = $paymentsApi->createPayment($body);
            return response()->json($result);
        } catch (ApiException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
