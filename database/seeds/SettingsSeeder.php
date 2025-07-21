<?php

use Illuminate\Database\Seeder;
use Krucas\Settings\Facades\Settings;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registration_text = 'Registration for the conference will be onsite and starts at 12 noon on Friday October 12, 2018.';
        Settings::set('registration_text', $registration_text);

        $cme_text = 'The meeting will be awarded 6 category I CME hours by Kuwait Institute for Medical Specialization.<br><br>Claim CME certificate using your email address or your mobile number. Before the certificate is issued, you will need to fill a short survey about the meeting.';

        $message = 'It gives us pleasure to welcome you to the First Joint Gulf Heart Association/European Society of Cardiology Meeting to be held in Kuwait during October 6-7, 2017.
                                
                                This meeting was established as a highlight of the collaboration between the Gulf Heart Association (GHA) and the European Society of Cardiology (ESC).  This collaboration has been in place since the inception of the GHA in 2002.
                                
                                We have created an exciting program that we hope will interest cardiologists and internists from the region.  The program features highlights from ESC 2017 congress in Barcelona, updates on recent guidelines and interactive case presentations and clinical challenges.  In addition we assigned a session to showcase regional projects established by the GHA.  There will be three satellite symposia arranged and managed by the pharmaceutical industry.
                                
                                Kuwait is the venue for this First Joint GHA/ESC Meeting.  The weather is pleasant in October and Kuwaitis are known for their hospitality.  Please do join us for this unique scientific activity.';

        Settings::set('cme_text', $cme_text);
        Settings::set('message', $message);
        Settings::set('certificates_enabled', false);
        Settings::set('registration_enabled', true);

    }
}
