<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentGateway;
use App\Configuration;

class PaymentGatewaysController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index()
    {
        $configuration = Configuration::first();
        $selected_payment_gateway = $configuration->payment_gateway;
        $paymentGateway = PaymentGateway::find($selected_payment_gateway);

        $test_creds = ($this->isJson($paymentGateway->test_creds)) ? json_decode($paymentGateway->test_creds, true) : [];
        $live_creds = ($this->isJson($paymentGateway->live_creds)) ? json_decode($paymentGateway->live_creds, true) : [];
        
        return view('admin.paymentGateways', compact('selected_payment_gateway', 'test_creds', 'live_creds'));
    }

    public function update(Request $request)
    {
        $configuration = Configuration::first();
        $selected_payment_gateway = $configuration->payment_gateway;
        $paymentGateway = PaymentGateway::find($selected_payment_gateway);

        $test_creds = [];
        $live_creds = [];

        if($selected_payment_gateway == 1) {
            $this->validate($request, [
                'secret_key_test' => 'required|min:1|max:255',
                'public_key_test' => 'required|min:1|max:255',
                'secret_key_live' => 'required|min:1|max:255',
                'public_key_live' => 'required|min:1|max:255',
                'merchantID'      => 'required|min:1|max:255'
            ]);


            $test_creds = [
                "secret_key" => $request['secret_key_test'],
                "public_key" => $request['public_key_test'],
                "merchantID" => $request['merchantID']
            ];

            $live_creds = [
                "secret_key" => $request['secret_key_live'],
                "public_key" => $request['public_key_live'],
                "merchantID" => $request['merchantID']
            ];
        }
        else if($selected_payment_gateway == 2) {
            $this->validate($request, [
                'url_test' => 'required|min:1|max:255',
                'key_test' => 'required|min:1|max:1000',
                'url_live' => 'required|min:1|max:255',
                'key_live' => 'required|min:1|max:1000'
            ]);

            $test_creds = [
                "url" => $request['url_test'],
                "key" => $request['key_test']
            ];

            $live_creds = [
                "url" => $request['url_live'],
                "key" => $request['key_live']
            ];
        }


        $paymentGateway->test_creds = json_encode($test_creds);
        $paymentGateway->live_creds = json_encode($live_creds);
        $paymentGateway->save();

        return redirect()->back()->with('message', 'Payment gateway page has been updated.');
    }

    function isJson($string) {
       json_decode($string);
       return json_last_error() === JSON_ERROR_NONE;
    }
}
