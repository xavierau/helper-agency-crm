<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 11:06 PM
 */

namespace Modules\AgencyCore\DataTransferObject;


class JobData
{

    private string $service_type;
    private string $status;
    private ?string $type;
    private ?string $nationality;
    private ?array $services;
    private ?string $note;
    private ?int $garden_size;
    private ?int $number_of_cars;
    private ?int $number_of_kids;
    private ?string $age_of_kids;
    private ?int $disabled_personnel;
    private ?string $pets;

    /**
     * @var \Modules\AgencyCore\DataTransferObject\RequirementData
     */
    private RequirementData $requirement;

    public static function fromFormData(array $validatedData): JobData {
        $instance = new self;

        $instance->service_type = $validatedData['service_type'];
        $instance->status = $validatedData['status'] ?? 'active';
        $instance->note = $validatedData['people']['note'] ?? null;
        $instance->type = $validatedData['people']['type'] ?? null;
        $instance->nationality = $validatedData['people']['nationality'] ?? null;
        $instance->services = $validatedData['people']['services'] ?? null;

        $instance->requirement = RequirementData::fromFormData($validatedData['people']);


        return $instance;
    }

    public function getJobData(): array {
        return [
            'service_type' => $this->service_type,
            'status'       => $this->status,
            'services'     => $this->services,
            'nationality'  => $this->nationality,
            'note'         => $this->note,
            'type'         => $this->type,
        ];
    }

    /**
     * @return \Modules\AgencyCore\DataTransferObject\RequirementData
     */
    public function getRequirement(): RequirementData {
        return $this->requirement;
    }


}
