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
 * @Date        : 24/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContractDate\Actions;


use Modules\AgencyContractDate\DataTransferObject\AssignContractDateData;
use Modules\AgencyContractDate\Entities\ContractDate;
use Modules\AgencyContractDate\Entities\ContractDateSet;

class AssignContractDate
{
    public function execute(AssignContractDateData $dto): ContractDate {
        $assignment = ContractDateSet::create([
                                                  'contract_type_id' => $dto->getContractType()->id,
                                                  'contract_date_id' => $dto->getContractDate()->id,
                                                  'order'            => $dto->getOrder(),
                                                  'is_required'      => $dto->getIsRequired(),
                                              ]);

        return $assignment->date;
    }
}
