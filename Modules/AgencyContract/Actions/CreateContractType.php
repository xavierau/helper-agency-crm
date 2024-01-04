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
 * @package     anacreation/agency-contract
 * @Date        : 22/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\Actions;


use Modules\AgencyContract\DataTransferObjects\ContractTypeData;
use Modules\AgencyContract\Entities\ContractType;

class CreateContractType
{
    public function execute(ContractTypeData $dto): ContractType {
        return ContractType::create(['label' => $dto->getLabel()]);
    }
}
