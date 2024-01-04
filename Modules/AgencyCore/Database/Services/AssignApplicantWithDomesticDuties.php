<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package
 * @Date        : 8/8/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\Database\Services;


use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\DomesticDuty;

class AssignApplicantWithDomesticDuties
{
    /**
     * @param \Modules\AgencyCore\Entities\Applicant $applicant
     * @return \Modules\AgencyCore\Entities\Applicant
     */
    public function __invoke(Applicant $applicant): Applicant {
        $count = DomesticDuty::count();

        $duties = DomesticDuty::inRandomOrder()
                              ->take(rand(1,
                                          $count))
                              ->get();

        $applicant->duties()->saveMany($duties);

        return $applicant;
    }
}
