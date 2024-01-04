<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 9:55 PM
 */

namespace Modules\AgencyCore\Actions;


use Modules\AgencyCore\DataTransferObject\RequirementData;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Entities\Requirement;

class CreateRequirement
{

    /**
     * @param \Modules\AgencyContract\Entities\Contract|Job $requirementOwner
     * @param \Modules\AgencyCore\DataTransferObject\RequirementData $dto
     * @return \Modules\AgencyCore\Entities\Requirement
     */
    public function execute($requirementOwner, RequirementData $dto): Requirement
    {
        $data = $dto->getRequirementData();

        return $requirementOwner->requirement()->create($data);

    }
}
