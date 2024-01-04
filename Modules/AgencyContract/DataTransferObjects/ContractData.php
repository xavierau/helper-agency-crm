<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 2:05 AM
 */

namespace Modules\AgencyContract\DataTransferObjects;


use App\Setting;
use Carbon\Carbon;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyCore\Entities\Address;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Entities\Requirement;

class ContractData
{

    private ?Carbon $start_date;
    private ?Carbon $end_date;
    private string $status;
    private string $internal_code;
    private string $contract_number;
    private Applicant $applicant;
    private Client $client;
    private ?ContractType $contractType;
    private ?Address $address;
    public ?Requirement $requirement;
    public int $salary;
    public int $food_subsidy;
    public ?string $special_request_1;
    public ?string $special_request_2;
    public ?string $special_request_3;

    private function __construct(array $formData)
    {
        $this->start_date = null;
        $this->end_date = null;
        $this->status = $formData['status'] ?? 'pending';
        $this->contract_number = $formData['contract_number'];
        $this->internal_code = $formData['internal_code'];
        $this->salary = $formData['salary'] ?? (int)Setting::fetch('salary');
        $this->food_subsidy = $formData['food_subsidy'] ?? (int)Setting::fetch('food_subsidy');
        $this->contract_number = $formData['contract_number'];
        $this->special_request_1 = $formData['special_request_1'] ?? null;
        $this->special_request_2 = $formData['special_request_2'] ?? null;
        $this->special_request_3 = $formData['special_request_3'] ?? null;
        $this->applicant = $this->fetchApplicant($formData);
        $this->client = Client::findOrFail($formData['client_id']);
        $this->contractType = $this->applicant->getContractType();
        $this->address = Address::find($formData['address_id'] ?? null);
        $this->requirement = isset($formData['requirement_id']) ?
            Requirement::find($formData['requirement_id']) :
            ((isset($formData['job_id']) && ($job = Job::find($formData['job_id']))) ?
                $job->requirement : null);
    }

    public static function fromFormData(array $formData): ContractData
    {
        return new self($formData);
    }

    /**
     * @return \Carbon\Carbon|null
     */
    public function getStartDate(): ?Carbon
    {
        return $this->start_date;
    }

    /**
     * @return \Carbon\Carbon|null
     */
    public function getEndDate(): ?Carbon
    {
        return $this->end_date;
    }

    /**
     * @return mixed|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Applicant|null
     */
    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    /**
     * @return \Modules\AgencyCore\Entities\Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    public function getContractData(): array
    {
        return [
            'client_id'         => $this->client->id,
            'contract_number'   => $this->contract_number,
            'contract_type_id'  => $this->contractType->id,
            'end_date'          => $this->end_date,
            'food_subsidy'      => $this->food_subsidy,
            'internal_code'     => $this->internal_code,
            'salary'            => $this->salary,
            'special_request_1' => $this->special_request_1,
            'special_request_2' => $this->special_request_2,
            'special_request_3' => $this->special_request_3,
            'start_date'        => $this->start_date,
            'status'            => $this->status,
        ];
    }

    /**
     * @return \Modules\AgencyContract\Entities\ContractType|null
     */
    public function getContractType(): ?\Modules\AgencyContract\Entities\ContractType
    {
        return $this->contractType;
    }


    /**
     * @return \Modules\AgencyCore\Entities\Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getContractNumber(): string
    {
        return $this->contract_number;
    }

    /**
     * @return mixed|\Modules\AgencyCore\Entities\Requirement|null
     */
    public function getRequirement(): ?Requirement
    {
        return $this->requirement;
    }

    private function fetchApplicant(array $formData)
    {
        return isset($formData['applicant_id']) ?
            Applicant::findOrFail($formData['applicant_id']) :
            Applicant::findOrFail($formData['applicant']['id']);
    }

    public function getNumberOfBedrooms()
    {
        return optional($this->requirement)->number_of_rooms ?? 0;
    }

    public function getAccommodationType()
    {
        return optional($this->requirement)->accommodation_type ?? "";
    }

    public function getAccommodationValue()
    {
        return optional($this->requirement)->accommodation_value ?? 0;
    }

    public function getDayoffArrangement()
    {
        return optional($this->requirement)->dayoff_arrangement ?? '';
    }

    public function getInternalCode(): string
    {
        return $this->internal_code;
    }
}
