<?php

namespace App\Mail;

use App\Registration;
use Illuminate\Support\Facades\Mail;

class SimpleEmailService
{
    /**
     * Send registration confirmation email with QR code
     *
     * @param Registration $registration
     * @param string $qrCode
     * @return void
     */
    public static function sendRegistrationEmail(Registration $registration, $qrCode)
    {
        Mail::send('emails.confirmation', [
            'registration' => $registration,
            'qrCode' => $qrCode
        ], function ($message) use ($registration) {
            $message->to($registration->email, $registration->first_name . ' ' . $registration->last_name)
                    ->subject('Registration Confirmation - The Second Joint GHA/ESC Meeting');
        });
    }
}
