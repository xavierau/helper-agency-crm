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

namespace Modules\AgencyContractDoc\Actions;


use Modules\AgencyContractDoc\DataTransferObject\AssignContractDocData;
use Modules\AgencyContractDoc\Entities\ContractDoc;
use Modules\AgencyContractDoc\Entities\ContractDocSet;

class AssignContractDoc
{
    public function execute(AssignContractDocData $dto): ContractDoc {
        $assignment = ContractDocSet::create([
                                                 'contract_type_id' => $dto->getContractType()->id,
                                                 'contract_doc_id'  => $dto->getContractDoc()->id,
                                                 'order'            => $dto->getOrder(),
                                                 'is_required'      => $dto->getIsRequired(),
                                             ]);

        return $assignment->doc;
    }
}
