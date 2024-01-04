<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 5:43 PM
 */

namespace Modules\AgencyCore\Actions;


use Modules\AgencyCore\DataTransferObject\JobApplicantData;
use Modules\AgencyCore\Entities\Job;

class AssignApplicantToJob
{
    public function execute(Job $job, JobApplicantData $dto): Job {
        $job->applicants()->attach($dto->getApplicantId(),
                                   $dto->getData());

        return $job;
    }
}
