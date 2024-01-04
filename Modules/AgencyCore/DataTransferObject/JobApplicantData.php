<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 5:44 PM
 */

namespace Modules\AgencyCore\DataTransferObject;


use Illuminate\Support\Collection;
use Modules\AgencyCore\Entities\Applicant;

class JobApplicantData
{

    private Applicant $applicant;
    private Collection $applicants;
    private ?string $channel;
    private string $status;

    public static function fromFormData(array $data): JobApplicantData {
        $instance = new self;
        $instance->channel = $data['channel'] ?? null;
        $instance->status = $data['status'] ?? 'active';
        $instance->applicant = Applicant::findOrFail($data['applicant_id']);

        return $instance;
    }

    public static function fromMassFormData(array $data): JobApplicantData {
        $instance = new self;
        $instance->channel = $data['channel'] ?? null;
        $instance->status = $data['status'] ?? 'active';
        $instance->applicants = Applicant::whereIn('id',
                                                   $data['id'])
                                         ->get();

        return $instance;
    }

    public function getApplicantId(): int {
        return $this->applicant->id;
    }

    public function getApplicantIds(): array {
        return $this->applicants->map(fn(Applicant $a) => $a->id)
                                ->toArray();
    }


    public function getData(): array {
        return [
            'applicant_id' => $this->getApplicantId(),
            'channel'      => $this->channel,
            'status'       => $this->status,
        ];
    }

    public function getMassData(): array {
        return [
            'ids'     => $this->getApplicantIds(),
            'channel' => $this->channel,
            'status'  => $this->status,
        ];
    }
}
