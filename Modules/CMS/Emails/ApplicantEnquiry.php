<?php

namespace Modules\CMS\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class ApplicantEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public Collection $applicants;
    public array $contactInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $applicants, array $contactInfo)
    {
        $this->applicants = $applicants;
        $this->contactInfo = $contactInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('cms::mail.applicants.enquiry')
            ->from('website@anacreation.com');
    }
}
