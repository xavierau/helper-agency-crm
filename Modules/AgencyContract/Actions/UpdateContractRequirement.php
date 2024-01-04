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
 * @Date        : 21/12/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\Actions;


use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyCore\DataTransferObject\RequirementData;
use Modules\AgencyCore\Entities\Requirement;

class UpdateContractRequirement
{

    public function execute(Contract $contract, RequirementData $dto): Requirement {
        $requirement = $contract->requirement ?? Requirement::create();

        $requirement->update($dto->getRequirementData());

        return $requirement;
    }
}
