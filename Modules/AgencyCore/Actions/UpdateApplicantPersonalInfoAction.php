<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 5:43 PM
 */

namespace Modules\AgencyCore\Actions;


use Modules\AgencyCore\DataTransferObject\JobApplicantData;
use Modules\AgencyCore\DataTransferObject\UpdatePersonalInfoDTO;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Http\Requests\UpdatePersonalInfoRequest;

class UpdateApplicantPersonalInfoAction
{
    public function execute(
        Applicant             $applicant,
        UpdatePersonalInfoDTO $dto
    ): Applicant
    {
        $applicant->update($dto->getData());

        return $applicant;
    }
}
