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
 * @Date        : 22/12/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\Actions;


use Modules\AgencyCore\DataTransferObject\RequirementData;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Entities\Requirement;

class UpdateJobRequirement
{
    public function execute(Job $job, RequirementData $dto): Requirement {
        $requirement = $job->requirement ?? Requirement::create();

        $requirement->update($dto->getRequirementData());

        return $requirement;
    }
}
