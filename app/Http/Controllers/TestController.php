<?php

namespace App\Http\Controllers;

use App\PaymentGateway;
use App\Registration;
use Image;
use File;
use Mail;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TestController extends Controller
{
    public function cert() {
        dd('none');
        $registration = Registration::find(24);
        $imagePath = public_path('images/GHA23Certificate_old.png');
        $imageData = file_get_contents($imagePath);
        $imageDataUri = base64_encode($imageData);

        //// check points ////
        $points = 15;
        if($registration->onlyWorkshop) $points = 6;
        else if($registration->workshop_id) {
            $points = 21;
        }
        //// check points ////

        try {
            $pdf = app()->make('dompdf.wrapper')->setPaper('a4', 'landscape');
            $pdf->loadHtml("<style>html{margin:0;}</style><div style='text-align: center; margin-top: 0; position: relative;'><h3 style='position: absolute; top: 290px; left: 220px; font-weight: normal; font-size: 26px; width: 60%; font-family: Arial, sans-serif; color: #000000;'>" . ucwords($registration->title . ". " . $registration->first_name . " " . $registration->last_name) . "</h3><h3 style='position: absolute;top: 500px;left: 170px;font-weight: normal;font-size: 23px;width: 60%;font-family: Arial, sans-serif;color: #000000;'>".$points."</h3><img src='data:image/jpeg;base64,{$imageDataUri}' style='width: 93%;'></div>");
            return $pdf->download('GHA23_cert_'.$registration->id.'.pdf');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function howtocert() {

        $emails = [];

        dd($emails);

        // $virtualRegistration = Registration::where('attended', 1)->get();
        // foreach ($virtualRegistration as $key => $value)
        // {
        //     if($value->Payment->paid_status == 1) {
        //         $emails[] = [
        //             'name' => $value->title.' '.$value->first_name.' '.$value->last_name,
        //             'email' => $value->email
        //         ];
        //     }
        // }

        $emails[] = [
            'name' => 'Dr Ihab Fattah',
            'email' => 'drihabaf@hotmail.com'
        ];

        if(count($emails))
        {
            foreach ($emails as $email)
            {
                Mail::send(
                    'emails.cert',
                    [
                        'name' => $email['name']
                    ],
                    function ($m) use ($email) {
                        $m->to($email['email'], $email['name'])
                        ->subject('Get Certificate Steps')
                        ->from('conferences@zawaya.me', 'GHA');

                    }
                );
            }
        }    
    }

    public function sendSteps() {

        $emails = [];
        dd($emails);
        $virtualRegistration = Registration::where('virtualAccess', 1)->get();
        foreach ($virtualRegistration as $key => $value)
        {
            if($value->Payment->paid_status == 1) {
                $emails[] = [
                    'name' => $value->title.' '.$value->first_name.' '.$value->last_name,
                    'email' => $value->email
                ];
            }
        }

        if(count($emails))
        {
            foreach ($emails as $email)
            {
                Mail::send(
                    'emails.steps',
                    [
                        'name' => $email['name']
                    ],
                    function ($m) use ($email) {
                        $m->to($email['email'], $email['name'])
                        ->subject('Virtual Access Steps')
                        ->from('conferences@zawaya.me', 'GHA');

                    }
                );
            }
        }    
    }

    public function index() {
        return view('test');
    }

    public function save(Request $request) {

        // $member = PaymentGateway::where('live_creds', 'test')->first();
        // if(!$member) $member = new PaymentGateway();

        // $member->name = $request['name'];
        // $member->live_creds = "test";
        // $member->active = 0;

        // if($request->hasFile('image_file')) {
        //     $image = $request->file('image_file');
        //     $image_name = 'test_2_10_2023.' . $image->getClientOriginalExtension();
        //     File::delete('images/faculty/' . $image_name);


        //     $logo = Image::make($image->getRealPath());
        //     $logo->resize(387, 446, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save('images/faculty/' . $image_name);

        //     $member->test_creds = $image_name;
        // } else {
        //     $member->test_creds = "";
        // }
        // $member->save();

        if(
            (isset($request['id']) && $request['id'] != null && $request['id'] != "") || 
            (isset($request['email']) && $request['email'] != null && $request['email'] != "")
        )
        {
            if(isset($request['id']) && $request['id'] != null && $request['id'] != "") $registration = Registration::find($request['id']);
            else $registration = Registration::where('email', $request['email'])->first();

            if(!$registration) return redirect('admin/mail')->withErrors(['error' => 'User is incorrect'])->withInput();

            $this->sendMail($registration->id);
            return redirect('admin/mail')->with('message', "Email send successfully");
        }
        else
        {
            return redirect('admin/mail')->withErrors(['error' => 'Please enter ID or an email'])->withInput();
        }
        // $request['id']
        // $request['email']

        // return redirect('admin/mail')->with('message', "Email send successfully");
        // return redirect('admin/mail')->withErrors(['error' => 'Something went wrong'])->withInput();
        
    }

    private function sendMail($id) {
        $registration = Registration::find($id);

        if($registration)
        {
            if($registration->Payment->paid_status == 1)
            {
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
            }
        }
    }

    // public function mail() {
    //     $this->sendMail(302);
    //     // $this->sendMail(74);
    //     // $this->sendMail(178);

    //     return redirect('test')->with('message', "Done");
    // }

    // public function delete() {
    //     $image_name = 'test_2_10_2023.jpg';
    //     File::delete('images/faculty/' . $image_name);
    //     $resutls = PaymentGateway::where('live_creds', 'test')->delete();
    //     return redirect('test')->with('message', "Done");
    // }
}
