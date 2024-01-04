<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 6:31 PM
 */

namespace Modules\AgencyCore\Actions;


use Illuminate\Support\Facades\DB;
use Modules\AgencyCore\DataTransferObject\ApplicantDTO;
use Modules\AgencyCore\Entities\Applicant;
use Throwable;

class CreateNewApplicant
{

    public function execute(ApplicantDTO $data): Applicant
    {

        $applicantData = $data->getFormData();

        $new_applicant = Applicant::create($applicantData);

        $new_applicant->duties()->sync($data->getDuties());

        return $new_applicant;

    }
}
