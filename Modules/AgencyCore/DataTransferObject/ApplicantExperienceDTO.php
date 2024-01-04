<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 6:33 PM
 */

namespace Modules\AgencyCore\DataTransferObject;


use Illuminate\Support\Collection;
use Modules\AgencyCore\Http\Requests\ApplicantStoreRequest;

class ApplicantExperienceDTO
{

    private Collection $experienceDataCollection;

    private array $formData = [];

    public static function fromFormRequest(ApplicantStoreRequest $request): ApplicantExperienceDTO
    {
        $instance = new static;

        $instance->sanitizeApplicantExperienceData($request);

        return $instance;
    }

    public static function fromValidatedData(array $array): ApplicantExperienceDTO
    {
        $instance = new static;

        $instance->experienceDataCollection = collect($array);

        return $instance;
    }

    private function sanitizeApplicantExperienceData(ApplicantStoreRequest $request)
    {
        $data = $request->validated();;
        $this->experienceDataCollection = collect($data['experience']);
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function getExperienceDataCollection(): Collection
    {
        return $this->experienceDataCollection;
    }

    public static function FromFormData(array $data): static
    {
        $dto = new ApplicantExperienceDTO();

        $dto->formData = $data;

        return $dto;

    }

    public function getFormData(): array
    {
        return $this->formData;
    }

    /**
     * @return Array<Int>
     */
    public function getDomesticDutyIds(): array
    {
        return $this->formData['duties'] ?? [];
    }
}
