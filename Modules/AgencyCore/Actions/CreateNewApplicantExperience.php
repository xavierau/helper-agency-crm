<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 6:32 PM
 */

namespace Modules\AgencyCore\Actions;


use Modules\AgencyCore\DataTransferObject\ApplicantExperienceDTO;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\ApplicantExperience;

class CreateNewApplicantExperience
{

    /**
     * @param \Modules\AgencyCore\Entities\Applicant $applicant
     * @param \Modules\AgencyCore\DataTransferObject\ApplicantExperienceDTO $data
     * @return \Illuminate\Support\Collection [ApplicantExperience]
     */
//    public function execute(Applicant $applicant, ApplicantExperienceDTO $data)
//    {
//        return $data->getExperienceDataCollection()
//            ->map(function (array $data) use ($applicant) {
//                $data['status'] = $data['status'] ?? 'finished';
//
//                $domestic_duty_ids = $data['duties'];
//
//                unset($data['duties']);
//
//                $applicant_experience = $applicant->experiences()->create($data);
//
//                $applicant_experience->duties()->sync($domestic_duty_ids);
//
//                return $applicant_experience;
//            });
//    }
    public function execute(Applicant $applicant, ApplicantExperienceDTO $data
    ): ApplicantExperience
    {

        $d = $data->getFormData();

        $ids = $data->getDomesticDutyIds();

        /** @var ApplicantExperience $applicant_experience */
        $applicant_experience = $applicant->experiences()->create($d);

        $applicant_experience->duties()->sync($ids);

        return $applicant_experience;

    }
}
