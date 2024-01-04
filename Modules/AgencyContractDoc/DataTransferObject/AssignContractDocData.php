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

namespace Modules\AgencyContractDoc\DataTransferObject;


use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyContractDoc\Entities\ContractDoc;

class AssignContractDocData
{
    private ContractType $contractType;
    private ContractDoc $contractDoc;
    private int $order;
    private bool $is_required;

    public static function fromFormData(array $validatedData): self {

        $instance = new self;

        $instance->order = $validatedData['order'];
        $instance->is_required = $validatedData['is_required'];
        $instance->contractType = ContractType::findOrFail($validatedData['contract_type_id']);
        $instance->contractDoc = ContractDoc::findOrFail($validatedData['contract_doc_id']);

        return $instance;

    }

    /**
     * @return \Modules\AgencyContract\Entities\ContractType
     */
    public function getContractType(): \Modules\AgencyContract\Entities\ContractType {
        return $this->contractType;
    }

    /**
     * @return \Modules\AgencyContractDate\Entities\ContractDate
     */
    public function getContractDoc(): \Modules\AgencyContractDoc\Entities\ContractDoc {
        return $this->contractDoc;
    }

    /**
     * @return int
     */
    public function getOrder(): int {
        return $this->order;
    }

    /**
     * @return bool
     */
    public function getIsRequired(): bool {
        return $this->is_required;
    }

}
