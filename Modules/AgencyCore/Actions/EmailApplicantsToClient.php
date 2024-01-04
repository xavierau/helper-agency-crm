<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 6:06 PM
 */

namespace Modules\AgencyCore\Actions;


use Illuminate\Support\Facades\Mail;
use Modules\AgencyCore\DataTransferObject\JobApplicantData;
use Modules\AgencyCore\Emails\SendRecommendedApplicant;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Job;

class EmailApplicantsToClient
{
    public function execute(Job $job, JobApplicantData $dto): void {
        $applicants = Applicant::whereIn('id',
                                         $dto->getApplicantIds())
                               ->get();

        Mail::to('xavier.au@anacreation.com')
            ->send(new SendRecommendedApplicant($job->client,
                                                $applicants));

        $applicants->each(fn(Applicant $applicant) => $job->applicants()
                                                          ->attach($applicant->id,
                                                                   [
                                                                       'status'  => 'active',
                                                                       'channel' => 'email',
                                                                   ]));
    }
}
