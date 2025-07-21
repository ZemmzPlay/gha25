<?php

namespace App\Http\Controllers;

use Request;
use Settings;

class ContentController extends Controller
{
    public function getRegistration() {
        $registration_text = Settings::get('registration_text');
        $cme_text = Settings::get('cme_text');
        return view('admin.content.registration-form', compact('registration_text', 'cme_text'));
    }

    public function postRegistration() {
        $registration_text = Request::get('registration_text');
        $cme_text = Request::get('cme_text');
        Settings::set('registration_text', $registration_text);
        Settings::set('cme_text', $cme_text);

        return redirect()->back()->with('message', 'Registration & CME page has been updated.');
    }

    public function messageForm() {
        $message_title = Settings::get('message_title');
        $message = Settings::get('message');
        
        return view('admin.content.message-form', compact('message_title', 'message'));

    }

    public function updateMessage() {
        $message_title = Request::get('message_title');
        $message = Request::get('message');
        Settings::set('message_title', $message_title);
        Settings::set('message', $message);
        
        return redirect()->back()->with('message', 'Message has been updated.');
    }
}
