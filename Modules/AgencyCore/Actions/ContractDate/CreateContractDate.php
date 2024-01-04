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
 * @package     anacreation/agency-core
 * @Date        : 22/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\Actions\ContractDate;


use Modules\AgencyCore\DataTransferObject\ContractDate\ContractDateData;
use Modules\AgencyCore\Entities\ContractDate;

class CreateContractDate
{
    public function execute(ContractDateData $dto): ContractDate {
        return ContractDate::create(['label' => $dto->getLabel()]);
    }
}
