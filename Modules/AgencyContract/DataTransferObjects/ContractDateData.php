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
 * @package     ${PACKAGE}
 * @Date        : 22/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\DataTransferObjects;


use Carbon\Carbon;
use Modules\AgencyContractDate\Entities\ContractDate;

class ContractDateData
{
    private ContractDate $contractDate;
    private ?Carbon $date;

    public static function fromFormData(array $validatedData): ContractDateData {
        $instance = new self;

        $instance->contractDate = ContractDate::findOrFail($validatedData['contract_date_id']);
        $instance->date = isset($validatedData['value']) && $validatedData['value'] !== null ?
            Carbon::parse($validatedData['value']):
            null;

        return $instance;
    }

    /**
     * @return \Modules\AgencyContractDate\Entities\ContractDate
     */
    public function getContractDate(): \Modules\AgencyContractDate\Entities\ContractDate {
        return $this->contractDate;
    }

    /**
     * @return \Carbon\Carbon|null
     */
    public function getDate(): ?\Carbon\Carbon {
        return $this->date;
    }


}
