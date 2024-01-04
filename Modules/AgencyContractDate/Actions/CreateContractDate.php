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
 * @package     anacreation/agency-contract-date
 * @Date        : 31/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContractDate\Actions;


use Modules\AgencyContractDate\DataTransferObject\ContractDateData;
use Modules\AgencyContractDate\Entities\ContractDate;

class CreateContractDate
{

    public function execute(ContractDateData $dto): ContractDate {

        return ContractDate::create(['label' => $dto->getLabel()]);

    }
}
