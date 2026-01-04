<?php

namespace App\Http\Controllers;

use App\Exports\AttendeesExport;
use App\Exports\CertificateDownloadersExport;
use App\Exports\RegistrationsExport;
use App\Exports\WorkshopExport;
use App\Configuration;
use App\Registration;
use App\Payment;
use App\RegistrationWorkshop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Excel;
use App\Workshop;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Mail;

class RegistrationsController extends Controller
{
    public function getRegistrations() {
        $workshops = Workshop::all();
        // apply filters by workshop
        if(request()->has('workshop_id') && request()->get('workshop_id') != '') {
            $workshopId = request()->get('workshop_id');
            $registrations = Registration::whereHas('RegistrationWorkshops', function($query) use ($workshopId) {
                $query->where('workshop_id', $workshopId);
            })->get();
        } else {
            $registrations = Registration::all();
        }
        $workshops = RegistrationWorkshop::all();
        foreach($workshops as $workshop) {
            $registration = Registration::find($workshop->registration_id);
            if(!$registration)
                $workshop->delete();
        }    
        $user = Auth::guard('admin')->user();
        return view('admin.registrations.registrations', compact('user','registrations', 'workshops'));
    }

    public function getCreate() {
        $method = 'post';
        $user = Auth::guard('admin')->user();
        $registration = new Registration();
        $workshops = Workshop::all();
        return view('admin.registrations.registration-form', compact('method', 'registration', 'user', 'workshops'));
    }


    public function postCreate(Request $request) {
        $this->validate($request, [
            'title'            => 'required|in:Prof,Dr,Mr,Mrs,Miss',
            'first_name'       => 'required|max:255',
            'last_name'        => 'required|max:255',
            'speciality'       => 'required|max:255',
            'country'          => 'required|max:255',
            'city'             => 'required|max:255',
            'email'            => 'required|email|max:255',
            'countryCode'      => 'required|max:255',
            'mobile'           => 'required|max:255',
            'receive_updates'  => 'required|in:0,1',
            'onlyWorkshop'     => 'required|in:0,1',
            'virtualAccess'    => 'required|in:0,1',
            'sendEmail'        => 'sometimes|nullable|in:0,1',
            'workshop_id'      => 'sometimes|nullable|exists:workshops,id|required_if:onlyWorkshop,1'
        ], ['workshop_id.required_if' => 'The workshop field is required.']);

        $data = $request->all();


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
                return redirect()->back()->withErrors(['message' => 'No places left for this worshop']);
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
                    return redirect()->back()->withErrors(['message' => 'The email has already been taken']);
                }
            }
        }
        //// check if email used and paid ////

        $configuration = Configuration::find(1);

        //// calculate total price ////
        $total = 20;
        if($data['virtualAccess'] == 1) $total = 10;

        if($data['onlyWorkshop'] == 1) $total = $workshopPrice;
        else if($data['workshop_id'] != null) $total += $workshopPrice;
        //// calculate total price ////

        $payment = new Payment;
        $payment->amount_paid = $total;
        $payment->paid_status = 1;
        $payment->payment_status = 'BY ADMIN';
        $payment->transaction_data = '{"TransactionStatus":"REDIRECT"}';
        $payment->payment_gateway = $configuration->payment_gateway;
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
        $payment->save();


        //////////////////// SEND EMAIL PART ////////////////////
        if(isset($data['sendEmail']) && $data['sendEmail'] == 1)
        {
            $this->sendConfirmationEmail($registration);
            
            // $qrcode = QrCode::format('png')->size(200)->generate(url('admin/registrations/' . $registration->id . '/print'));
            // Mail::send(
            //     'emails.confirmation',
            //     [
            //         'registration' => $registration,
            //         'qrCode' => $qrcode
            //     ],
            //     function ($m) use ($registration) {
            //         $m->to($registration->email, $registration->first_name)
            //         ->subject('Registration Confirmation')
            //         ->from('conferences@zawaya.me', 'GHA');

            //     }
            // );
        }
        //////////////////// SEND EMAIL PART ////////////////////


        return redirect('admin/registrations/'.$registration->id.'/edit')->with('message', $registration->first_name . " has been registered.");
    }

    public function getEdit($id) {
        $user = Auth::guard('admin')->user();
        $registration = Registration::find($id);
        $workshops = Workshop::all();
        if(!$registration)
            abort(404);
        return view('admin.registrations.registration-form', [
            'registration'    => $registration,
            'method'    => 'put',
            'user'      => $user,
            'workshops' => $workshops
        ]);
    }

    public function postEdit($id, Request $request) {
        $registration = Registration::find($id);
        if(!$registration)
            abort(404);

        $this->validate($request, [
            'title'            => 'required|in:Prof,Dr,Mr,Mrs,Miss',
            'first_name'       => 'required|max:255',
            'last_name'        => 'required|max:255',
            'speciality'       => 'required|max:255',
            'country'          => 'required|max:255',
            'city'             => 'required|max:255',
            'email'            => 'required|max:255|email|unique:registrations,email,'.$registration->id,
            'countryCode'      => 'required|max:255',
            'mobile'           => 'required|max:255',
            'receive_updates'  => 'required|in:0,1',
            'onlyWorkshop'     => 'required|in:0,1',
            'virtualAccess'    => 'required|in:0,1',
            'paidByAdmin'      => 'sometimes|nullable|in:0,1',
            'sendEmail'        => 'sometimes|nullable|in:0,1',
            'workshop_id_old'  => 'sometimes|nullable|exists:workshops,id',
            'workshop_id'      => 'sometimes|nullable|exists:workshops,id|required_if:onlyWorkshop,1'
        ], ['workshop_id.required_if' => 'The workshop field is required.']);

        $data = $request->all();


        $workshopPrice = 0;
        if($data['workshop_id'] != null)
        {
            $workshop = Workshop::find($data['workshop_id']);
            $workshopPrice = $workshop->price;
        }

        //////////// check if there is more places on this worshop ////////////
        if(
            $data['workshop_id'] != null && 
            $data['workshop_id_old'] != $data['workshop_id']
        )
        {
            $checkReservedPlaces = Registration::where('workshop_id', $data['workshop_id'])
                                        ->join('payments', 'registrations.payment_id', '=', 'payments.id')
                                        ->where('payments.paid_status', 1)
                                        ->get();

            if($workshop->places <= count($checkReservedPlaces))
            {
                return redirect()->back()->withErrors(['message' => 'No places left for this worshop']);
            }
        }
        //////////// check if there is more places on this worshop ////////////


        $registration->title = $data['title'];
        $registration->first_name = $data['first_name'];
        $registration->last_name = $data['last_name'];
        $registration->speciality = $data['speciality'];
        $registration->country = $data['country'];
        $registration->city = $data['city'];
        $registration->countryCode = $data['countryCode'];
        $registration->mobile = $data['mobile'];
        $registration->email = $data['email'];
        $registration->receive_updates = $data['receive_updates'];
        $registration->onlyWorkshop = $data['onlyWorkshop'];
        $registration->virtualAccess = $data['virtualAccess'];
        $registration->workshop_id = $data['workshop_id'];

        if(isset($data['paidByAdmin']) && $data['paidByAdmin'] == 1)
        {
            $configuration = Configuration::find(1);

            //// calculate total price ////
            $total = 20;
            if($data['virtualAccess'] == 1) $total = 10;

            if($data['onlyWorkshop'] == 1) $total = $workshopPrice;
            else if($data['workshop_id'] != null) $total += $workshopPrice;
            //// calculate total price ////

            $payment = new Payment;
            $payment->amount_paid = $total;
            $payment->paid_status = 1;
            $payment->payment_status = 'BY ADMIN';
            $payment->transaction_data = '{"TransactionStatus":"REDIRECT"}';
            $payment->payment_gateway = $configuration->payment_gateway;
            $payment->registration_id = $registration->id;
            $payment->save();
            $registration->payment_id = $payment->id;
        }

        $registration->save();

        //////////////////// SEND EMAIL PART ////////////////////
        if(isset($data['sendEmail']) && $data['sendEmail'] == 1)
        {
            $this->sendConfirmationEmail($registration);

            // $qrcode = QrCode::format('png')->size(200)->generate(url('admin/registrations/' . $registration->id . '/print'));
            // Mail::send(
            //     'emails.confirmation',
            //     [
            //         'registration' => $registration,
            //         'qrCode' => $qrcode
            //     ],
            //     function ($m) use ($registration) {
            //         $m->to($registration->email, $registration->first_name)
            //         ->subject('Registration Confirmation')
            //         ->from('conferences@zawaya.me', 'GHA');

            //     }
            // );
        }
        //////////////////// SEND EMAIL PART ////////////////////

        return redirect()->back()->with('message', "Registration has been updated.");

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


    public function getExport() {
        $registrations = Registration::all();
        Excel::create('Registrants | amsd2017.com', function($excel) use($registrations) {

            $excel->sheet('AMSD2017 Registrations', function($sheet) use($registrations) {

                $sheet->fromArray($registrations);

            });

        })->download('xls');
    }

    public function getPrint($id) {
        $registration = Registration::find($id);
        $registration->attended = 1;
        $registration->save();
        return view('admin.registrations.print', compact('registration'));
    }

    public function exportRegistrants($workshopId = null)
    {
        // return Excel::download(new RegistrationsExport, "GHA23 Registrants - " . Carbon::now()->format('Ymd').'.xlsx');
        // $workshopId = request()->query('workshop_id', null);
        // $workshop = null;
        if($workshopId) {
            $workshop = Workshop::find($workshopId);
            if(!$workshop) {
                abort(404, "Workshop not found");
            }
        }
        $workshopName = $workshopId ? str_replace('/', '-', $workshop->title) : '';
        $fileName = ($workshopId ? "Workshop{$workshopName}" : 'Registrants') . " - " . Carbon::now()->format('Ymd') . '.xlsx';
        return Excel::download(new RegistrationsExport($workshopId), $fileName);
    }

    public function exportAttendees() {
        return Excel::download(new AttendeesExport, "GHA23 Attendees - " . Carbon::now()->format('Ymd').'.xlsx');

    }

    public function exportWorkshop($id) {
        // dd(new WorkshopExport($id));
        return Excel::download(new WorkshopExport($id), "GHA23 Attendees - " . Carbon::now()->format('Ymd').'.xlsx');

    }

    public function exportCertificateDownloaders() {
        return Excel::download(new CertificateDownloadersExport, "GHA23 Certificate Downloaders - " . Carbon::now()->format('Ymd').'.xlsx');

    }
}
