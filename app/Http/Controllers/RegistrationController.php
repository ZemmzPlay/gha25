<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegistrationRequest;
use App\Http\Requests\SubmitEvaluationRequest;
use App\Http\Requests\VerifyRegistrationRequest;
use App\Registration;
use Mail, Illuminate\Support\Facades\DB;
use App\Question, App\GeneralQuestion;
use App\Mail\RegistrationConfirmationEmail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Configuration;
use App\Payment;
use Crypt;
use Auth;

use App\ConferenceQuestions;
use App\Workshop;
use App\Session;

use App\Classes\TwilioVerify;
use DateTime;

class RegistrationController extends Controller
{
    public function create(CreateRegistrationRequest $request) {
        if(Auth::guard('web')->check()) return redirect('/');

        $request['onlyWorkshop'] = 0;
        $request['workshop_id'] = null;
        $data = $request->all();
        $data['onlyWorkshop'] = 0;
        $data['workshop_id'] = null;
        


        //////// check if free (for yemen and palestine) ////////
        $freeRegistrationSpecial = true;
        // if(($data['countryCode'] == "+967" || $data['countryCode'] == "+970") && $data['virtualAccess'] == 1)
        //     $freeRegistrationSpecial = true;
        //////// check if free (for yemen and palestine) ////////


        $workshopPrice = 0;
        //////////// check if there is more places on this worshop ////////////
        if($data['workshop_id'] != null)
        {
            $workshop = Workshop::find($data['workshop_id']);
            $checkReservedPlaces = Registration::where('workshop_id', $data['workshop_id'])
                                        ->join('payments', 'registrations.payment_id', '=', 'payments.id')
                                        ->where('payments.paid_status', 1)
                                        ->get();

            if($workshop->places <= count($checkReservedPlaces))
            {
                return redirect()->back()->withErrors(['message' => 'No places left for this worshop'])->withInput();
            }

            $workshopPrice = $workshop->price;
        }
        //////////// check if there is more places on this worshop ////////////



        //// check if email used and paid ////
        $registration = Registration::where('email', $data['email'])->first();
        if($registration) {
            if(isset($registration->Payment)) {
                $paid_status = $registration->Payment->paid_status;
                if($paid_status == 1) {
                    return redirect()->back()->withErrors(['message' => 'The email has already been taken'])->withInput();
                }
                // else {
                //     Payment::where('id', $registration->payment_id)->delete();
                // }
            }
        }
        //// check if email used and paid ////



        ///////// check payment gateway /////////
        $payment_gateway_id = 0;
        if(!$freeRegistrationSpecial)
        {
            $configuration = Configuration::find(1);
            $isLive = ($configuration->payment_status == 'live');
            $payment_gateway_id = $configuration->payment_gateway;
            $paymentGateway = $configuration->PaymentGateway;
            if(!$paymentGateway)
                return redirect()->back()->withErrors(['message' => 'Error, please try again later'])->withInput();

            $paymentGatewayCreds = ($isLive) ? $paymentGateway->live_creds : $paymentGateway->test_creds;
            $paymentGatewayCreds = json_decode($paymentGatewayCreds);
        }
        ///////// check payment gateway /////////


        ///////////////////////////////////////////////////////////////////////
        //////////////////////////// PAYMENT PART ////////////////////////////

        //// calculate total price ////
        $total = 20;
        if($data['virtualAccess'] == 1) $total = 10;

        if($data['onlyWorkshop'] == 1) $total = $workshopPrice;
        else if($data['workshop_id'] != null) $total += $workshopPrice;
        //// calculate total price ////

        $payment = new Payment;
        $payment->amount_paid = ($freeRegistrationSpecial) ? 0 : $total;
        $payment->payment_gateway = $payment_gateway_id;

        if($freeRegistrationSpecial) {
            $payment->payment_status = 'OTP NOT VERIFIED';
            $payment->transaction_data = json_encode(['Total' => $total, 'otp_count' => 1]);
        }

        $payment->save();
        $paymentID = $payment->id;
        $data['payment_id'] = $paymentID;

        if(!$registration) $registration = Registration::create($data);
        else {
            $registration->title = $data['title'];
            $registration->first_name = $data['first_name'];
            $registration->last_name = $data['last_name'];
            $registration->speciality = $data['speciality'];
            $registration->country = $data['country'];
            $registration->city = $data['city'];
            $registration->countryCode = $data['countryCode'];
            $registration->mobile = $data['mobile'];
            $registration->receive_updates = $data['receive_updates'];
            $registration->payment_id = $paymentID;
            $registration->workshop_id = $data['workshop_id'];
            $registration->onlyWorkshop = $data['onlyWorkshop'];
            $registration->virtualAccess = $data['virtualAccess'];
            $registration->save();
        }

        $payment->registration_id = $registration->id;

        //////////////////////////// PAYMENT PART ////////////////////////////
        ///////////////////////////////////////////////////////////////////////







        $FINAL_PAYMENT_URL = "";
        if(!$freeRegistrationSpecial)
        {
            ///////////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////////------------------- TAP -------------------////////////////////////////
            
            ///////////////// REQUEST USING THE CHARGE API /////////////////
            $merchantID = $paymentGatewayCreds->merchantID;
            $secret_key = $paymentGatewayCreds->secret_key;
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $countryCode = str_replace('+', '', $data['countryCode']);
            $mobile = $data['mobile'];
            $redirectURL = url('/register/payment/'. Crypt::encrypt($paymentID));


            // Request data
            $dataReq = '{
                "amount": '.$total.',
                "currency": "KWD",
                "threeDSecure": true,
                "save_card": false,
                "metadata": {
                    "paymentID": "'.$paymentID.'"
                },
                "receipt": {
                    "email": false,
                    "sms": true
                },
                "customer": {
                    "first_name": "'.$first_name.'",
                    "middle_name": "",
                    "last_name": "'.$last_name.'",
                    "email": "'.$email.'",
                    "phone": {
                        "country_code": "'.$countryCode.'",
                        "number": "'.$mobile.'"
                    }
                },
                "merchant": {
                    "id": "'.$merchantID.'"
                },
                "source": {
                    "id": "src_all"
                },
                "post": {
                    "url": "'.$redirectURL.'"
                },
                "redirect": {
                    "url": "'.$redirectURL.'"
                }
            }';


            // cURL setup
            $ch = curl_init();
            $url = 'https://api.tap.company/v2/charges';

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataReq);

            // Set headers
            $headers = [
                'Authorization: Bearer '.$secret_key,
                'accept: application/json',
                'content-type: application/json',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Execute cURL request
            $response = curl_exec($ch);

            // Check for cURL errors
            $err = curl_error($ch);

            // Close cURL session
            curl_close($ch);

            // Output the response
            if ($err) {
                // echo "cURL Error #:" . $err;
                // dd($err);
            } else {
                if($this->isJson($response))
                {
                    $response = json_decode($response, true);
                    if(isset($response['status'])) $payment->payment_status = $response['status'];

                    if(isset($response['transaction']) && isset($response['transaction']['url']))
                        $FINAL_PAYMENT_URL = $response['transaction']['url'];
                }
            }
            ///////////////// REQUEST USING THE CHARGE API /////////////////

            ////////////////////////////------------------- TAP -------------------////////////////////////////
            ///////////////////////////////////////////////////////////////////////////////////////////////////
        }

        $payment->save();



        if(!$freeRegistrationSpecial && $FINAL_PAYMENT_URL != "")
            return redirect()->away($FINAL_PAYMENT_URL);


        if($freeRegistrationSpecial) {
            $phoneNumberFinal = $data['countryCode'].$data['mobile'];
            TwilioVerify::createSMSVerification($phoneNumberFinal, []);
            return redirect(url('/register/verify-otp/'. Crypt::encrypt($paymentID)));
        }

        
        return redirect()->back()->withErrors(['message' => 'Error, please try again later'])->withInput();

        /////////////// OLD JS PROBLEM ///////////////
        // $items = [
        //     [
        //         'id' => 1,
        //         'name' => 'registration',
        //         'quantity' => 1,
        //         'price' => $total,
        //         'total' => $total,
        //     ]
        // ];

        // $public_key = $paymentGatewayCreds->public_key;
        // $merchantID = $paymentGatewayCreds->merchantID;

        // return view('payments.paymentTap', [
        //     'first_name' => $data['first_name'],
        //     'last_name' => $data['last_name'],
        //     'email' => $data['email'],
        //     'countryCode' => str_replace('+', '', $data['countryCode']),
        //     'mobile' => $data['mobile'],
        //     'total' => $total,
        //     'items' => $items,
        //     'paymentID' => $paymentID,
        //     'public_key' => $public_key,
        //     'merchantID' => $merchantID
        // ]);
        // }
        /////////////// OLD JS PROBLEM ///////////////
        






        // Mail::to($registration->email)->send(new RegistrationConfirmationEmail($registration));
        // return redirect()->back()->with(['message' => 'Thank you for your registration', 'id' => $registration->id]);
    }

    public function otpValidation($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $paymentData = Payment::find($id);
        if(!$paymentData) abort(404);
        if($paymentData->paid_status == 1) abort(404);
        if($paymentData->payment_gateway != 0) abort(404);
        $registration = $paymentData->registration;
        if(!$registration) abort(404);


        return view('otp.otpVerify', ['registration' => $registration, 'paymentData' => $paymentData]);
    }

    public function otpVerifyAction(Request $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $paymentData = Payment::find($id);
        if(!$paymentData) abort(404);
        if($paymentData->paid_status == 1) abort(404);
        if($paymentData->payment_gateway != 0) abort(404);
        $registration = $paymentData->registration;
        if(!$registration) abort(404);


        $this->validate($request, [
            'otpCode' => 'required|numeric|integer|digits:6',
        ], [
            'otpCode.required' => 'OTP Code is required', 
            'otpCode.numeric' => 'Please enter a valid OTP Code',
            'otpCode.integer' => 'Please enter a valid OTP Code',
            'otpCode.digits' => 'OTP Code should be 6 digits'
        ]);


        $phoneNumberFinal = $registration->countryCode.$registration->mobile;

        $verificationRes = false;
        try {
            $verification = TwilioVerify::VerifyOTP($request['otpCode'], $phoneNumberFinal);
            if($verification->valid) $verificationRes = true;
        } catch (\Throwable $e) {} catch (\Exception $e) {}
        
        if ($verificationRes)
        {
            $paymentData->paid_status = 1;
            $paymentData->payment_status = 'OTP VERIFIED';
            $paymentData->payment_error = null;
            $paymentData->save();

            /////////////// EMAIL PART HERE AFTER PAYMENT SUCCESS ///////////////
            $this->sendConfirmationEmail($registration);
            /////////////// EMAIL PART HERE AFTER PAYMENT SUCCESS ///////////////

            return redirect('/register/payment-result/success/'.$registration->id);
        }
        else
        {
            $paymentData->paid_status = 2;
            $paymentData->payment_status = 'OTP VERIFICATION FAILED';
            $paymentData->payment_error = 'OTP VERIFICATION FAILED';
            $paymentData->save();

            return redirect()->back()->withErrors(['message' => 'OTP Verification Failed']);
        }
    }

    public function updatePhoneNumber(Request $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $paymentData = Payment::find($id);
        if(!$paymentData) abort(404);
        if($paymentData->paid_status == 1) abort(404);
        if($paymentData->payment_gateway != 0) abort(404);
        $registration = $paymentData->registration;
        if(!$registration) abort(404);

        $this->validate($request, [
            'mobile' => 'required|numeric|integer',
        ], [
            'mobile.required' => 'Phone number is required', 
            'mobile.numeric' => 'Please enter a valid phone number',
            'mobile.integer' => 'Please enter a valid phone number'
        ]);


        //// check if phone number exists ////
        $checkPhoneNumber = Registration::where('countryCode', $registration->countryCode)
                                        ->where('mobile', $request['mobile'])
                                        ->where('id', '!=', $registration->id)
                                        ->first();
        if($checkPhoneNumber)
        {
            return redirect()->back()->withErrors(['message' => 'Phone number already used']);
        }
        //// check if phone number exists ////


        //// update phone ////
        $registration->mobile = $request['mobile'];
        $registration->save();
        //// update phone ////


        //// send otp if allowed ////
        $transaction_data = $paymentData->transaction_data;
        if($transaction_data != "" && $this->isJson($transaction_data))
        {
            $checkOTPCountData = $this->checkOTPCount($transaction_data, $paymentData->updated_at);
            $sendOtp = $checkOTPCountData['sendOtp'];
            $transaction_data = $checkOTPCountData['transaction_data'];

            if($sendOtp)
            {
                $phoneNumberFinal = $registration->countryCode.$registration->mobile;
                TwilioVerify::createSMSVerification($phoneNumberFinal, []);
                $paymentData->transaction_data = json_encode($transaction_data);
                $paymentData->save();
            }
        }
        //// send otp if allowed ////

        
        return redirect()->back()->with(['message' => 'Phone number updated successfully']);
    }

    public function resendOtpCode($id)
    {
        ////////// Validation part //////////
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $paymentData = Payment::find($id);
        if(!$paymentData) abort(404);
        if($paymentData->paid_status == 1) abort(404);
        if($paymentData->payment_gateway != 0) abort(404);
        $registration = $paymentData->registration;
        if(!$registration) abort(404);
        ////////// Validation part //////////


        $transaction_data = $paymentData->transaction_data;
        if($transaction_data != "" && $this->isJson($transaction_data))
        {
            $checkOTPCountData = $this->checkOTPCount($transaction_data, $paymentData->updated_at);
            $sendOtp = $checkOTPCountData['sendOtp'];
            $transaction_data = $checkOTPCountData['transaction_data'];

            if($sendOtp)
            {
                $phoneNumberFinal = $registration->countryCode.$registration->mobile;
                TwilioVerify::createSMSVerification($phoneNumberFinal, []);
                $paymentData->transaction_data = json_encode($transaction_data);
                $paymentData->save();

                return redirect()->back()->with(['message' => 'OTP Sent successfully']);
            }
            else
            {
                return redirect()->back()->withErrors(['message' => 'You have exceeded the maximum number of OTPs allowed per day']);
            }
        }
    }

    private function checkOTPCount($transaction_data, $updated_at)
    {
        $sendOtp = false;
        $transaction_data = json_decode($transaction_data, true);
        if(isset($transaction_data['otp_count']))
        {
            if($transaction_data['otp_count'] < 3) {
                $sendOtp = true;
                $transaction_data['otp_count'] = $transaction_data['otp_count'] + 1;
            }
            else {
                //// check if 24 hours passed since last otp sent ////
                $timeNow = date('Y-m-d H:i:s');
                $updated_at_datetime = new DateTime($updated_at);
                $time_now_datetime = new DateTime($timeNow);
                $time_difference = $time_now_datetime->diff($updated_at_datetime);
                $total_hours_difference = $time_difference->h + ($time_difference->days * 24);
                if ($total_hours_difference >= 24) {
                    $sendOtp = true;
                    $transaction_data['otp_count'] = 1;
                }
                //// check if 24 hours passed since last otp sent ////
            }
        }

        return [
            'sendOtp' => $sendOtp,
            'transaction_data' => $transaction_data
        ];
    }

    private function sendConfirmationEmail($registration)
    {
        /////////////// EMAIL PART HERE AFTER PAYMENT SUCCESS ///////////////
        if(!$registration->onlyWorkshop)
        {
            $qrcode = QrCode::format('svg')->size(200)->generate(url('admin/registrations/' . $registration->id . '/print'));
            \App\Mail\SimpleEmailService::sendRegistrationEmail($registration, $qrcode);
        }

        if($registration->workshop_id)
        {
            Mail::send(
                'emails.workshop',
                [
                    'registration' => $registration
                ],
                function ($m) use ($registration) {
                    $m->to($registration->email, $registration->first_name)
                    ->subject('Workshop Details')
                    ->from('conferences@zawaya.me', 'GHA');

                }
            );
        }
        /////////////// EMAIL PART HERE AFTER PAYMENT SUCCESS ///////////////
    }


    public function paymentValidation(Request $request, $id)
    {
        ///////// check payment gateway /////////
        $configuration = Configuration::find(1);
        $isLive = ($configuration->payment_status == 'live');
        $payment_gateway_id = $configuration->payment_gateway;
        $paymentGateway = $configuration->PaymentGateway;
        if(!$paymentGateway) abort(404);
        $paymentGatewayCreds = ($isLive) ? $paymentGateway->live_creds : $paymentGateway->test_creds;
        $paymentGatewayCreds = json_decode($paymentGatewayCreds);
        ///////// check payment gateway /////////


        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $paymentData = Payment::find($id);
        if(!$paymentData) abort(404);

        ///// check if link already used /////
        if($paymentData->transaction_data != null) abort(404);
        ///// check if link already used /////


        $paidValue = 0;
        $paymentStatus = null;
        $paymentError = null;
        $transaction_data = json_encode(['TransactionStatus' => 'REDIRECT']);


        ////------------------- TAP -------------------////
        // if($payment_gateway_id == 1)
        // {
        if(!isset($request['tap_id'])) abort(404);

        $secret_key = $paymentGatewayCreds->secret_key;
        $tap_id = $request['tap_id'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/charges/".$tap_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$secret_key
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
            if($this->isJson($response))
            {
                $response = json_decode($response, true);
                if(isset($response['status']))
                {
                    // INITIATED, IN_PROGRESS, ABANDONED, CANCELLED, FAILED, 
                    // CAPTURED, VOID, TIMEDOUT, UNKNOWN, DECLINED, RESTRICTED
                    $status = $response['status'];
                    $paymentStatus = $status;
                    $paidValue = 2;
                    if($status == 'INITIATED' || $status == 'IN_PROGRESS') $paidValue = 0;
                    if($status == 'CAPTURED') $paidValue = 1;
                    if($paidValue == 2) $paymentError = "transaction ".$status;
                }
            }
        }
        // }
        ////------------------- TAP -------------------////


        $paymentData->paid_status = $paidValue;
        $paymentData->payment_status = $paymentStatus;
        $paymentData->payment_error = $paymentError;
        $paymentData->transaction_data = $transaction_data;
        $paymentData->save();

        $registration_id = $paymentData->registration->id;


        ///// success payments /////
        if($paidValue == 1) {

            $registration = Registration::find($registration_id);

            /////////////// EMAIL PART HERE AFTER PAYMENT SUCCESS ///////////////
            $this->sendConfirmationEmail($registration);
            /////////////// EMAIL PART HERE AFTER PAYMENT SUCCESS ///////////////


            return redirect('/register/payment-result/success/'.$registration_id);

        }
        ///// success payments /////

        return redirect('/register/payment-result/failed');
    }

    public function paymentResult($slot, $registration_id = null)
    {
        if($slot != 'success' && $slot != 'failed') abort(404);
        if ($slot == 'failed' && $registration_id != null) abort(404);
        if ($slot == 'success' && $registration_id == null) abort(404);
        if ($registration_id != null && !ctype_digit($registration_id)) abort(404);
        return view('payments.paymentResult', ['result' => $slot, 'registration_id' => $registration_id]);
    }

    function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * print the payment result
     */
    public function printPaymentResult($slot, $registration_id = null)
    {
        return view('payments.printPaymentResult', ['result' => $slot, 'registration_id' => $registration_id])->render();
    }



    public function completeFailedPayment($id) {

        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        
        $registration = Registration::where('id', $id)->first();

        if(!$registration) abort(404);
        if(isset($registration->Payment) && $registration->Payment->paid_status == 1)  abort(404);

        $virtualAccess = $registration->virtualAccess;
        $workshop_id = $registration->workshop_id;
        $onlyWorkshop = $registration->onlyWorkshop;
        $first_name = $registration->first_name;
        $last_name = $registration->last_name;
        $email = $registration->email;
        $countryCode = str_replace('+', '', $registration->countryCode);
        $mobile = $registration->mobile;

        $workshopPrice = 0;
        //////////// check if there is more places on this worshop ////////////
        if($workshop_id != null)
        {
            $workshop = Workshop::find($workshop_id);
            $checkReservedPlaces = Registration::where('workshop_id', $workshop_id)
                                        ->join('payments', 'registrations.payment_id', '=', 'payments.id')
                                        ->where('payments.paid_status', 1)
                                        ->get();

            if($workshop->places <= count($checkReservedPlaces))
            {
                return view('error', ['msg' => 'There are no available slots remaining for the '.$workshop->title.' workshop.'])->render();
            }

            $workshopPrice = $workshop->price;
        }
        //////////// check if there is more places on this worshop ////////////



        ///////// check payment gateway /////////
        $configuration = Configuration::find(1);
        $isLive = ($configuration->payment_status == 'live');
        $payment_gateway_id = $configuration->payment_gateway;
        $paymentGateway = $configuration->PaymentGateway;
        if(!$paymentGateway) abort(404);

        $paymentGatewayCreds = ($isLive) ? $paymentGateway->live_creds : $paymentGateway->test_creds;
        $paymentGatewayCreds = json_decode($paymentGatewayCreds);
        ///////// check payment gateway /////////



        //////////////////////////////////////////////////////////////////////
        //////////////////////////// PAYMENT PART ////////////////////////////
        //// calculate total price ////
        $total = 20;
        if($virtualAccess == 1) $total = 10;

        if($onlyWorkshop == 1) $total = $workshopPrice;
        else if($workshop_id != null) $total += $workshopPrice;
        //// calculate total price ////

        $payment = new Payment;
        $payment->amount_paid = $total;
        $payment->payment_gateway = $payment_gateway_id;
        $payment->registration_id = $registration->id;
        $payment->save();
        $paymentID = $payment->id;


        $registration->payment_id = $paymentID;
        $registration->save();
        //////////////////////////// PAYMENT PART ////////////////////////////
        //////////////////////////////////////////////////////////////////////









        ///////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////------------------- TAP -------------------////////////////////////////
        
        ///////////////// REQUEST USING THE CHARGE API /////////////////
        $FINAL_PAYMENT_URL = "";
        $merchantID = $paymentGatewayCreds->merchantID;
        $secret_key = $paymentGatewayCreds->secret_key;
        $redirectURL = url('/register/payment/'. Crypt::encrypt($paymentID));


        // Request data
        $dataReq = '{
            "amount": '.$total.',
            "currency": "KWD",
            "threeDSecure": true,
            "save_card": false,
            "metadata": {
                "paymentID": "'.$paymentID.'"
            },
            "receipt": {
                "email": false,
                "sms": true
            },
            "customer": {
                "first_name": "'.$first_name.'",
                "middle_name": "",
                "last_name": "'.$last_name.'",
                "email": "'.$email.'",
                "phone": {
                    "country_code": "'.$countryCode.'",
                    "number": "'.$mobile.'"
                }
            },
            "merchant": {
                "id": "'.$merchantID.'"
            },
            "source": {
                "id": "src_all"
            },
            "post": {
                "url": "'.$redirectURL.'"
            },
            "redirect": {
                "url": "'.$redirectURL.'"
            }
        }';


        // cURL setup
        $ch = curl_init();
        $url = 'https://api.tap.company/v2/charges';

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataReq);

        // Set headers
        $headers = [
            'Authorization: Bearer '.$secret_key,
            'accept: application/json',
            'content-type: application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        $err = curl_error($ch);

        // Close cURL session
        curl_close($ch);

        // Output the response
        if ($err) {
            // echo "cURL Error #:" . $err;
            // dd($err);
        } else {
            if($this->isJson($response))
            {
                $response = json_decode($response, true);
                if(isset($response['status'])) $payment->payment_status = $response['status'];

                if(isset($response['transaction']) && isset($response['transaction']['url']))
                    $FINAL_PAYMENT_URL = $response['transaction']['url'];
            }
        }
        ///////////////// REQUEST USING THE CHARGE API /////////////////

        $payment->save();

        if($FINAL_PAYMENT_URL != "")
            return redirect()->away($FINAL_PAYMENT_URL);
        
        abort(404);
    }





    public function verify(VerifyRegistrationRequest $request) {
        $id = $request->get('id');
        $registration = Registration::find($id);


        ///////////// check if user paid /////////////
        $paid_status = $registration->Payment->paid_status;
        if($paid_status != 1) {
            return redirect()->back()->withErrors(['message' => 'Your account is not active']);
        }
        ///////////// check if user paid /////////////


        if(!$registration->attended) {
            return redirect()->back()->withErrors(['message' => 'You have not attended the event.']);
        }
        if(!$registration->answered) {
            return redirect()->route('evaluation.form')->with(['registration' => $registration]);
        }
        return $this->downloadCertificate($registration);
    }

    public function evaluationForm() {

        ///////////////// REMOVE ME LATER /////////////////
        // $registration = Registration::find(1);
        // $questions = Question::whereRaw('id <= 12')->get();
        // $questions2 = Question::whereRaw('id > 12')->get();
        // $general_questions = GeneralQuestion::all();
        // return view('evaluation', compact('questions','questions2', 'general_questions', 'registration'));
        ///////////////// REMOVE ME LATER /////////////////


        if(session()->has('registration')) {
            $registration = session()->get('registration');

            ///////////// check if user paid /////////////
            $paid_status = $registration->Payment->paid_status;
            if($paid_status != 1) {
                return redirect()->back()->withErrors(['message' => 'Your account is not active']);
            }
            ///////////// check if user paid /////////////


            $questions = Question::whereRaw('id <= 12')->get();
            $questions2 = Question::whereRaw('id > 12')->get();
            $general_questions = GeneralQuestion::all();
            return view('evaluation', compact('questions','questions2', 'general_questions', 'registration'));
        } else {
            return redirect('/');
        }
    }



    public function evaluate(SubmitEvaluationRequest $request) {
        $registration_id        = $request->get('registration_id');
        $answers                = $request->get('answers');
        $questions              = $request->get('questions');
        $general_questions      = $request->get('general_questions');
        $registration           = Registration::find($registration_id);


        ///////////// check if user paid /////////////
        $paid_status = $registration->Payment->paid_status;
        if($paid_status != 1) {
            abort(404);
        }
        ///////////// check if user paid /////////////


        if(!$registration->answered) {
            for ($i = 0; $i < count($answers); $i++) {
                DB::table('question_registration')->insert([
                    'registration_id' => $registration_id,
                    'question_id' => $questions[$i],
                    'answer' => $answers[$i]
                ]);
            }

            if($general_questions) {
                for ($i = 0; $i < count($general_questions); $i++) {
                    DB::table('general_question_registration')->insert([
                        'registration_id' => $registration_id,
                        'general_question_id' => $general_questions[$i]
                    ]);
                }
            }


            $registration->comment = $request->get('comment');
            $registration->suggestion = $request->get('suggestion');
            $registration->answered = true;
            $registration->save();
        }


        return $this->downloadCertificate($registration);
    }

    private function downloadCertificate(Registration $registration) {
        // $pdf = app()->make('dompdf.wrapper')->setPaper('a4', 'landscape');
        // $pdf->loadHtml("<style>html{margin:0;}</style><div style='text-align: center; margin-top: 0; position: relative;'><h3 style='position: absolute; top: 300px; left: 220px; font-weight: normal; font-size: 26px; width: 60%; font-family: Arial, sans-serif; color: #000000;'>" . ucwords($registration->title . ". " . $registration->first_name . " " . $registration->last_name) . "</h3><img src='".asset('images/certificate.jpg')."' style='width: 93%;'></div>");
        // return $pdf->download('GHAESC2019_cert_'.$registration->id.'.pdf');

        $imagePath = public_path('images/GHA23Certificate_old.png');
        $imageData = file_get_contents($imagePath);
        $imageDataUri = base64_encode($imageData);

        //// check points ////
        $points = 15;
        if($registration->onlyWorkshop) $points = 6;
        else if($registration->workshop_id && ($registration->workshop_id == 1 || $registration->workshop_id == 2)) {
            $points = 21;
        }
        //// check points ////

        $pdf = app()->make('dompdf.wrapper')->setPaper('a4', 'landscape');
        $pdf->loadHtml("<style>html{margin:0;}</style><div style='text-align: center; margin-top: 0; position: relative;'><h3 style='position: absolute; top: 290px; left: 220px; font-weight: normal; font-size: 26px; width: 60%; font-family: Arial, sans-serif; color: #000000;'>" . ucwords($registration->title . ". " . $registration->first_name . " " . $registration->last_name) . "</h3><h3 style='position: absolute;top: 500px;left: 170px;font-weight: normal;font-size: 23px;width: 60%;font-family: Arial, sans-serif;color: #000000;'>".$points."</h3><img src='data:image/jpeg;base64,{$imageDataUri}' style='width: 93%;'></div>");
        return $pdf->download('GHA23_cert_'.$registration->id.'.pdf');
    }








    ////// login and watch-live part //////
    public function login()
    {
        if(Auth::guard('web')->check()) return redirect('/');

        return view('login')->render();
    }
    public function postLogin(Request $request) {
        if(Auth::guard('web')->check()) return redirect('/');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'phone_code' => 'required|max:4',
            'phone_number' => 'required|max:30',
            'id' => 'required|integer',
        ]);

        // Custom error messages for each field
        $customMessages = [
            'email.required' => 'Please enter a valid email address.',
            'email.email' => 'The email format is invalid.',
            'phone_code.required' => 'Please select a phone code.',
            'phone_number.required' => 'Please enter your phone number.',
            'id.required' => 'Please enter your ID.',
            'id.numeric' => 'Please enter a valid ID.',
        ];

        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Registration::where('email', $request['email'])
                                ->where('countryCode', $request['phone_code'])
                                ->where('mobile', $request['phone_number'])
                                ->where('id', $request['id'])
                                ->first();

        if(!$user) return back()->withErrors('Login details are incorrect')->withInput();

        $Payment = $user->Payment;
        if($Payment->paid_status != 1) return back()->withErrors('Login details are incorrect')->withInput();

        Auth::guard('web')->login($user);

        return redirect('/watch-live');
    }
    public function logout() {
        Auth::guard('web')->logout();
        return redirect('/');
    }
    public function watchLive() {
        $configuration = Configuration::first();

        if(!$configuration->enableLiveConference) return redirect('/');

        $currentAndNextSession = $this->fetchCurrentAndNextSession(true);
        $currentSessionDateTime = $currentAndNextSession['currentSessionDateTime'];
        $nextSessionSeconds = $currentAndNextSession['nextSessionSeconds'];
        $allSessions = $currentAndNextSession['allSessions'];

        $allSessionStartingTimes = [];
        foreach ($allSessions as $session)
            $allSessionStartingTimes[] = date('Y_m_d_H_i', strtotime($session['date_time_from']));

        return view('watchLive', [
            'configuration' => $configuration,
            'allSessions' => $allSessions,
            'allSessionStartingTimes' => $allSessionStartingTimes,
            'current' => $currentSessionDateTime,
            'nextSessionSeconds' => $nextSessionSeconds
        ])->render();
    }
    public function sendQuestion(Request $request) {
        $configuration = Configuration::first();
        if(!$configuration->enableLiveConferenceQuestions)
        {
            $response = [
                "success" => false,
                "message" => 'At this time, questions are not allowed.'
            ];

            return response()->json($response);
        }


        $validator = Validator::make($request->all(), [
            'question' => 'required'
        ]);

        if ($validator->fails())
        {
            $response = [
                "success" => false,
                "message" => 'Question field is required'
            ];

            return response()->json($response);
        }

        $question = htmlspecialchars($request['question']);
        $question = trim($question);
        $question = strip_tags($question);

        
        $allSessions = $this->fetchSessions();

        /// fetch current session ///
        // $previousSessionDateTime = null;
        // $prev_session_id = "";
        $session_id = "";
        foreach ($allSessions as $oneSession)
        {
            $localTime = date('Y-m-d H:i:s');
            $date_time_from = $oneSession['date_time_from'];
            $date_time_to = $oneSession['date_time_to'];

            /// add extra min in case needed - COMMENT ME IF NOT NEEDED ///
            // $date_time_to_add_extra = new DateTime($date_time_to);
            // $date_time_to_add_extra->modify('+20 minutes');
            // $date_time_to = $date_time_to_add_extra->format('Y-m-d H:i:s');
            /// add extra min in case needed - COMMENT ME IF NOT NEEDED ///

            // Convert the strings to timestamps
            $localTimestamp = strtotime($localTime);
            $fromTimestamp = strtotime($date_time_from);
            $toTimestamp = strtotime($date_time_to);

            // Check if $localTimestamp is within the range
            if ($localTimestamp >= $fromTimestamp && $localTimestamp <= $toTimestamp) {
                $session_id = $oneSession['id'];
            }

            //// fetch the previous session datetime ////
            // if ($fromTimestamp < $localTimestamp) {
            //     if ($previousSessionDateTime === null || $fromTimestamp > strtotime($previousSessionDateTime)) {
            //         $previousSessionDateTime = $date_time_from;
            //         $prev_session_id = $oneSession['id'];
            //     }
            // }
            //// fetch the previous session datetime ////
        }
        /// fetch current session ///


        if($session_id == "") {
            $response = [
                "success" => false,
                "message" => 'Session either ended or didn\'t start yet'
            ];

            return response()->json($response);
        }


        $registration_id = Auth::guard('web')->user()->id;

        $localTime = date('Y-m-d H:i:s');

        $conferenceQuestions = new ConferenceQuestions;
        $conferenceQuestions->registration_id = $registration_id;
        $conferenceQuestions->session_id = $session_id;
        $conferenceQuestions->question = $question;
        $conferenceQuestions->created_at = $localTime;
        $conferenceQuestions->updated_at = $localTime;
        $conferenceQuestions->save();


        $response = [
            "success" => true,
            "message" => 'Question sent successfully'
        ];

        return response()->json($response);
    }
    public function fetchCurrentAndNextSession($fetchSessions = false) {
        $currentSessionDateTime = null;
        $previousSessionDateTime  = null;
        $nextSessionDateTime = null;
        $nextSessionSeconds = null;

        
        $allSessions = $this->fetchSessions();
        $largestTimeDiff = -1;
        $smallestTimeDiff = PHP_INT_MAX;
        foreach ($allSessions as $oneSessionKey => $oneSession)
        {
            $localTime = date('Y-m-d H:i:s');
            $date_time_from = $oneSession['date_time_from'];
            $date_time_to = $oneSession['date_time_to'];


            $localTimestamp = strtotime($localTime);
            $fromTimestamp = strtotime($date_time_from);
            $toTimestamp = strtotime($date_time_to);


            /// fetch current session ///
            if ($localTimestamp >= $fromTimestamp && $localTimestamp <= $toTimestamp) {
                $currentSessionDateTime = $oneSession['date_time_from'];
            }
            /// fetch current session ///

            //// fetch the previous session datetime ////
            if ($fromTimestamp < $localTimestamp) {
                if ($previousSessionDateTime === null || $fromTimestamp > strtotime($previousSessionDateTime)) {
                    $previousSessionDateTime = $date_time_from;
                }
            }
            //// fetch the previous session datetime ////

            //// fetch the next session datetime ////
            $timeDiffNext = $fromTimestamp - $localTimestamp;
            if ($timeDiffNext > 0 && $timeDiffNext < $smallestTimeDiff) {
                $smallestTimeDiff = $timeDiffNext;
                $nextSessionDateTime = $date_time_from;
            }
            //// fetch the next session datetime ////
        }
        
        
        //// fetch the next session in seconds ////
        if($nextSessionDateTime != null)
        {
            $currentDateTime = date('Y-m-d H:i:s');
            $specificTimestamp = strtotime($nextSessionDateTime);
            $currentTimestamp = strtotime($currentDateTime);
            $nextSessionSeconds = $specificTimestamp - $currentTimestamp;
        }
        //// fetch the next session in seconds ////


        /// if session is done then show the last active one ///
        if($currentSessionDateTime == null)
            $currentSessionDateTime = $previousSessionDateTime;
        /// if session is done then show the last active one ///


        /// if no session active yet then show the next one ///
        if($currentSessionDateTime == null)
            $currentSessionDateTime = $nextSessionDateTime;
        /// if no session active yet then show the next one ///


        if($currentSessionDateTime != null)
            $currentSessionDateTime = date('Y_m_d_H_i', strtotime($currentSessionDateTime));

        $dataToBeReturned = [
            "currentSessionDateTime" => $currentSessionDateTime,
            "nextSessionSeconds" => $nextSessionSeconds
        ];

        if($fetchSessions) $dataToBeReturned['allSessions'] = $allSessions;

        return $dataToBeReturned;
    }
    private function fetchSessions() {
        $dates = Session::orderBy('session_date')->orderBy('start_time')->get()->groupBy('session_date');

        $allSessions = [];
        foreach ($dates as $date => $sessions)
        {
            if($date != '2023-12-13')
            {
                if(count($sessions))
                {
                    foreach ($sessions as $session)
                    {
                        if (
                            (strpos($session->title, 'Session') !== false) || 
                            (strpos($session->title, 'session') !== false) || 
                            (strpos($session->title, 'Awards') !== false) || 
                            (strpos($session->title, 'awards') !== false) || 
                            (strpos($session->title, 'Closing') !== false) || 
                            (strpos($session->title, 'closing') !== false)
                        )
                        {
                            $oneSession = [];
                            $oneSession['id'] = $session->id;
                            $oneSession['date'] = $date;
                            $oneSession['title'] = $session->title;
                            if(isset($session->moderator)) $oneSession['moderator'] = $session->moderator->name;


                            //// get panelist ////
                            $panelistText = "";
                            $panelists = $session->panelists;
                            foreach ($panelists as $panelistkey => $panelist) {
                                $panelistText .= $panelist->name;
                                if($panelistkey < count($panelists) - 1) $panelistText .= ", ";
                            }
                            if($panelistText != "") $oneSession['panelists'] = $panelistText;
                            //// get panelist ////



                            /// lectures ///
                            $lecturesTimes = [];
                            $allLectures = [];
                            $lectures = $session->lectures;
                            if(count($lectures))
                            {
                                foreach ($session->lectures as $lecture)
                                {
                                    //// fetch speakers ////
                                    $speakerText = "";
                                    $speakers = $lecture->speakers;
                                    foreach ($speakers as $speakerkey => $speaker)
                                    {
                                        $speakerText .= $speaker->name;
                                        if($speakerkey < count($speakers) - 1) $speakerText .= ", ";
                                    }
                                    //// fetch speakers ////

                                    $oneLecture = [];
                                    $oneLecture['lecture_start_time'] = $lecture->lecture_start_time;
                                    $oneLecture['lecture_end_time'] = $lecture->lecture_end_time;
                                    $oneLecture['lecture_title'] = $lecture->lecture_title;
                                    if($speakerText != "") $oneLecture['speakers'] = $speakerText;
                                    $allLectures[] = $oneLecture;

                                    $lecturesTimes[] = $lecture->lecture_start_time;
                                    $lecturesTimes[] = $lecture->lecture_end_time;
                                }
                            }
                            if(count($allLectures)) $oneSession['lectures'] = $allLectures;
                            if(count($lecturesTimes))
                            {
                                $oneSession['start_time_from_lectures'] = min($lecturesTimes);
                                $oneSession['end_time_from_lectures'] = max($lecturesTimes);
                            }
                            /// lectures ///


                            $oneSession['start_time'] = $session->start_time;
                            $oneSession['end_time'] = $session->end_time;

                            $oneSession['date_time_from'] = (isset($oneSession['start_time_from_lectures'])) ? $date.' '.$oneSession['start_time_from_lectures'] : $date.' '.$session->start_time;
                            $oneSession['date_time_to'] = (isset($oneSession['end_time_from_lectures'])) ? $date.' '.$oneSession['end_time_from_lectures'] : $date.' '.$session->end_time;


                            $allSessions[] = $oneSession;
                        }
                    }
                }
            }
        }


        //// temp for testing ////
        // $allSessions = [];
        // $allSessions[] = [
        //     "id" => 1,
        //     "title" => "Session 1",
        //     "moderator" => "Abbas",
        //     "date_time_from" => "2023-11-07 09:30:00",
        //     "date_time_to" => "2023-11-07 15:05:00"
        // ];
        // $allSessions[] = [
        //     "id" => 2,
        //     "title" => "Session 2",
        //     "moderator" => "Samir",
        //     "date_time_from" => "2023-11-07 15:10:00",
        //     "date_time_to" => "2023-11-07 17:51:00"
        // ];
        // $allSessions[] = [
        //     "id" => 3,
        //     "title" => "Session 3",
        //     "moderator" => "Mounir",
        //     "date_time_from" => "2023-11-07 17:52:00",
        //     "date_time_to" => "2023-11-07 17:54:00"
        // ];
        // $allSessions[] = [
        //     "id" => 4,
        //     "title" => "Session 4",
        //     "moderator" => "Akram",
        //     "date_time_from" => "2023-11-07 17:55:00",
        //     "date_time_to" => "2023-11-07 19:23:00"
        // ];
        //// temp for testing ////


        return $allSessions;
    }
    ////// login and watch-live part //////
}
