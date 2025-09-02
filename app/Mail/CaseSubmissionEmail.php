<?php

namespace App\Mail;

use App\CaseSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CaseSubmissionEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $caseSubmission;

    public function __construct(CaseSubmission $caseSubmission)
    {
        $this->caseSubmission = $caseSubmission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.case-submission')
                    ->subject('We\'ve Received Your Case Submission');
    }
}
