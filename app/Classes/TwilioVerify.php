<?php

namespace App\Classes;

use Twilio\Rest\Client;

class TwilioVerify {

	public static function createSMSVerification($to, $options = []) {
		$token = config('services.twilio.token');
		$twilio_sid = config('services.twilio.sid');
		$twilio_verify_sid = config('services.twilio.verifySid');
		$twilio = new Client($twilio_sid, $token);
		$twilio->verify->v2->services($twilio_verify_sid)
			->verifications
			->create($to, "sms");
	}

	public static function VerifyOTP($verificationCode, $to) {
		$token = config('services.twilio.token');
		$twilio_sid = config('services.twilio.sid');
		$twilio_verify_sid = config('services.twilio.verifySid');
		$twilio = new Client($twilio_sid, $token);

		return $twilio->verify->v2->services($twilio_verify_sid)
			->verificationChecks
			->create(['code' => $verificationCode, 'to' => $to]);
	}
}