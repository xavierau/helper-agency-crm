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
 * @package     AgencyCore
 * @Date        : 15/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\Actions;


use Modules\AgencyContract\DataTransferObjects\ContractDateData;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContractDate\Entities\ContractDateValue;

class UpdateContractDate
{
    public function execute(Contract $contract, ContractDateData $dto): Contract {

        $value = ContractDateValue::updateOrCreate([
                                                       'contract_id'      => $contract->id,
                                                       'contract_date_id' => $dto->getContractDate()->id,
                                                   ],
                                                   ['value' => $dto->getDate()]);

        return $value->contract;
    }
}
