<?php

namespace App\Mail;

use App\Models\ProjectRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectRequestSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $projectRequest;

    /**
     * Create a new message instance.
     *
     * @param ProjectRequest $projectRequest
     * @return void
     */
    public function __construct(ProjectRequest $projectRequest)
    {
        $this->projectRequest = $projectRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Project Request Submission')
                    ->view('emails.project_request_submission');
    }
}