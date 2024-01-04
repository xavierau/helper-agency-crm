<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 2:05 AM
 */

namespace Modules\AgencyContract\Actions;


use Modules\AgencyContract\DataTransferObjects\ContractData;
use Modules\AgencyContract\Entities\Contract;

class CreateContract
{
    /**
     * @param \Modules\AgencyContract\DataTransferObjects\ContractData $contractData
     * @return \Modules\AgencyContract\Entities\Contract
     */
    public function execute(ContractData $contractData): Contract
    {

        $contract = Contract::create($contractData->getContractData());

        if ($contractData->requirement) {
            $contract->requirement()->save($contractData->getRequirement());
        }

        if ($applicant = $contractData->getApplicant()) {
            $contract->applicants()->save($applicant);
        }


        return $contract;
    }
}
