<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AbstractForm;

use Mail;

use App\Mail\RegistrationConfirmationEmail;
use App\Payment;
use App\Registration;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class AbstractController extends Controller
{
  public function list()
  {
    // $paymentData = Payment::find(6);
    // $registration = $paymentData->registration;
    // $registration = Registration::find(870);
    // return $registration->email;
    // Mail::to($registration->email)->send(new RegistrationConfirmationEmail($paymentData->registration));
    // $qrcode = QrCode::format('png')->size(400)->generate("abbas");
    // return $qrcode;
    $abstracts = AbstractForm::all();
    return view('admin.abstract.list', compact('abstracts'));
  }

  public function getAbstract(Request $request)
  {
    $id = $request->id;

    $abstract = AbstractForm::find($id);

    $view = view('admin.abstract.view', compact('abstract'))->render();

    return $view;
  }

  public function download($id)
  {
    $abstract = AbstractForm::find($id);

    return Storage::download('public\abstracts/' . $abstract->file);
  }

  // public function email()
  // {
  //   // $qrcode = QrCode::size(400)->generate("Test");
  //   // $qrcode = QrCode::format('png')->size(400)->generate("Test");
  //   // return view('emails.confirm', compact('qrcode'));
  //   // return $qrcode;

  //   $paymentData = Payment::find(4);
  //   $registration = $paymentData->registration;

  //   // $qrcode = QrCode::format('png')->size(200)->generate(url('registrations/' . $registration->id . '/print'));
  //    Mail::send(
  //           'emails.payment_incomplete',
  //           [
  //             'registration' => $registration
  //           ],
  //           function ($m) use ($registration) {
  //               $m->to($registration->email, $registration->first_name)
  //                   ->subject('Payment Incomplete')
  //                   ->from('conferences@zawaya.me', 'GHA');

  //           }
  //       );
  //   // $registration = Registration::find(870);
  //   // return $registration->email;
  //   // Mail::to($registration->email)->send(new RegistrationConfirmationEmail($paymentData->registration));
  //   return view('emails.payment_incomplete', compact('registration'));
  //   // return view('emails.confirm', compact('registration'));
  // }
}
