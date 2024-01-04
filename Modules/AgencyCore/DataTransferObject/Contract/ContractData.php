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

namespace Modules\AgencyCore\DataTransferObject\Contract;


use Carbon\Carbon;
use Modules\AgencyCore\Entities\Address;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Client;

class ContractData
{
    private Applicant $applicant;
    private Client $client;
    private ?Address $address;
    private ?string $status;
    private ?Carbon $start_date = null;
    private ?Carbon $end_date = null;
    private string $contract_number;

    public static function fromFormData(array $validatedData): ContractData {

        $instance = new self;

        $instance->applicant = Applicant::findOrFail($validatedData['applicant_id']);
        $instance->client = Client::findOrFail($validatedData['client_id']);
        $instance->address = $validatedData['address_id'] ?
            Address::findOrFail($validatedData['address_id']):
            null;
        $instance->status = $validatedData['status'];
        $instance->contract_number = $validatedData['contract_number'];

        return $instance;
    }

    /**
     * @return \Modules\AgencyCore\Entities\Applicant
     */
    public function getApplicant(): Applicant {
        return $this->applicant;
    }

    /**
     * @return \Modules\AgencyCore\Entities\Client
     */
    public function getClient(): Client {
        return $this->client;
    }

    /**
     * @return \Modules\AgencyCore\Entities\Address|null
     */
    public function getAddress(): ?Address {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string {
        return $this->status;
    }

    /**
     * @return \Carbon\Carbon|null
     */
    public function getStartDate(): ?Carbon {
        return $this->start_date;
    }

    /**
     * @return \Carbon\Carbon|null
     */
    public function getEndDate(): ?Carbon {
        return $this->end_date;
    }

    /**
     * @return string
     */
    public function getContractNumber(): string {
        return $this->contract_number;
    }
}
