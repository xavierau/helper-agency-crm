<?php

namespace Modules\AgencyCore\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Modules\AgencyCore\Entities\Client;

class SendRecommendedApplicant extends Mailable
{
    use Queueable, SerializesModels;

    public Client $client;
    public Collection $applicants;


    /**
     * Create a new message instance.
     *
     * @param \Modules\AgencyCore\Entities\Client $client
     * @param \Illuminate\Support\Collection      $applicants
     */
    public function __construct(Client $client, Collection $applicants) {

        $this->applicants = $applicants;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('agencycore::emails.applicants.recommendation')
                    ->from('system@anaceation.com');
    }
}
