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


use Modules\AgencyContract\DataTransferObjects\ContractData;
use Modules\AgencyContract\Entities\Contract;

class UpdateContract
{
    public function execute(Contract $contract, ContractData $dto): Contract {
        $contract->update([
                              'status'          => $dto->getStatus(),
                              'end_date'        => $dto->getEndDate(),
                              'client_id'       => $dto->getClient()->id,
                              'start_date'      => $dto->getStartDate(),
                              'contract_number' => $dto->getContractNumber(),
                          ]);

        if($address = $dto->getAddress()) {
            $contract->addresses()->detach();http://127.0.0.1:8080/api/agencyfinance/invoices
            $contract->addresses()->save($dto->getAddress());
        }


        return $contract;
    }
}
