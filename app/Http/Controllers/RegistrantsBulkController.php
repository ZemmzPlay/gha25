<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Registrants;
use App\Imports\RegistrantsImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Excel;
use Storage;
use Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class RegistrantsBulkController extends Controller
{
    public function list() {
        $registrants = Registrants::all();
        return view('admin.registrants.list', compact('registrants'));
    }

    public function confirm($id) {
        return redirect()->back()->withErrors(['message' => 'Something went wrong please check again']);
        $registrant = Registrants::find($id);
        if($registrant)
        {
            if($registrant->confirmed) return redirect()->back()->withErrors(['message' => 'This list already confirmed']);

            $file_path = 'public/registrants/'.$registrant->file;
            if(!Storage::exists($file_path)) return redirect()->back()->withErrors(['message' => 'There is no file']);
            
            $pathMain = Storage::disk('public')->path('registrants/'.$registrant->file);

            $registrantsImport = new RegistrantsImport;
            $sheet = Excel::import($registrantsImport, $pathMain);
            $data = $registrantsImport->data;

            if (!count($data)) return redirect()->back()->withErrors('message', 'Invalid data.');

            foreach ($data as $key => $value)
            {
                $title = (isset($value['title'])) ? $value['title'] : "";
                $first_name = (isset($value['first_name'])) ? $value['first_name'] : "";
                $last_name = (isset($value['last_name'])) ? $value['last_name'] : "";
                $speciality = (isset($value['speciality'])) ? $value['speciality'] : "";
                $countryCode = (isset($value['country_code'])) ? strval($value['country_code']) : "";
                $countryCode = (substr( $countryCode, 0, 1 ) === "+") ? $countryCode : "+".$countryCode;
                $mobile = (isset($value['mobile_number'])) ? strval($value['mobile_number']) : "";
                $email = (isset($value['email'])) ? $value['email'] : "";
                $country = (isset($value['country'])) ? $value['country'] : "";
                $city = (isset($value['city'])) ? $value['city'] : "";
                $sponsorCompany = (isset($value['sponsor_company'])) ? $value['sponsor_company'] : "";

                if(
                    ($title != "" && (strlen($title) < 256)) && 
                    ($first_name != "" && (strlen($first_name) < 256)) && 
                    ($last_name != "" && (strlen($last_name) < 256)) && 
                    ($speciality != "" && (strlen($speciality) < 256)) && 
                    ($countryCode != "" && (strlen($countryCode) < 256)) && 
                    ($mobile != "" && (strlen($mobile) < 256)) && 
                    ($email != "" && (strlen($email) < 256)) && 
                    ($country != "" && (strlen($country) < 256)) && 
                    ($city != "" && (strlen($city) < 256)) && 
                    ($sponsorCompany != "" && (strlen($sponsorCompany) < 256))
                )
                {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        ////// check if email exist //////
                        $checkUser = Registration::where('email', $email)->first();
                        ////// check if email exist //////

                        if(!$checkUser)
                        {
                            $registration = new Registration;
                            $registration->title = $title;
                            $registration->first_name = $first_name;
                            $registration->last_name = $last_name;
                            $registration->speciality = $speciality;
                            $registration->countryCode = $countryCode;
                            $registration->mobile = $mobile;
                            $registration->email = $email;
                            $registration->country = $country;
                            $registration->city = $city;
                            $registration->sponsorCompany = $sponsorCompany;
                            $registration->registrant_id = $id;
                            $registration->save();

                            /////////////// EMAIL PART HERE AFTER PAYMENT SUCCESS ///////////////
                            $qrcode = QrCode::format('png')->size(200)->generate(url('admin/registrations/' . $registration->id . '/print'));
                            Mail::send(
                                'emails.confirmation',
                                [
                                    'registration' => $registration,
                                    'qrCode' => $qrcode
                                ],
                                function ($m) use ($registration) {
                                    $m->to($registration->email, $registration->first_name)
                                    ->subject('Registration Confirmation')
                                    ->from('conferences@zawaya.me', 'GHA');

                                }
                            );
                            /////////////// EMAIL PART HERE AFTER PAYMENT SUCCESS ///////////////
                        }
                    }
                }
            }


            $registrant->confirmed = 1;
            $registrant->save();
        }

        /// success
        return redirect('admin/registrants-bulk/')->with('message', "List confirmed");
    }
}
