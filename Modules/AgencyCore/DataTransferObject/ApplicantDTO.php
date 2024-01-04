<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 6:33 PM
 */

namespace Modules\AgencyCore\DataTransferObject;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\AgencyCore\Enums\ApplicantStatus;
use Modules\AgencyCore\Http\Requests\ApplicantStoreRequest;
use Modules\AgencyCore\Services\ApplicantEducationAttribute;
use Modules\AgencyCore\Services\ApplicantEmergencyAttribute;
use Modules\AgencyCore\Services\ApplicantFamilyAttribute;
use Modules\AgencyCore\Services\ApplicantPersonalDocumentsAttribute;
use Modules\AgencyCore\Services\ApplicantPreferenceAttribute;
use Modules\AgencyCore\Services\HolidayArrangementAttribute;
use Modules\AgencyCore\Services\QuestionsAttribute;
use Modules\AgencyCore\Services\SetSchemalessAttribute;

class ApplicantDTO
{

    private array $formData;

    public static function fromFormRequest(ApplicantStoreRequest $request): ApplicantDTO
    {

        $instance = new static;

        $instance->sanitizeApplicantData($request);

        return $instance;
    }

    public static function fromArray(array $array): ApplicantDTO
    {

        $instance = new static;

        $instance->formData = $array;

        return $instance;
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        $data = $this->formData;
        unset($data['experience']);
        unset($data['duties']);

        return $this->setDefaultValues($data);

    }

    /**
     * @return Array<ApplicantExperienceDTO>
     */
    public function getExperienceDTOs(): array
    {
        return collect($this->formData['experience'])
            ->map(fn(array $data) => ApplicantExperienceDTO::FromFormData($data))
            ->toArray();
    }

    private function sanitizeApplicantData(ApplicantStoreRequest $request): void
    {
        $this->formData = $request->validated();
    }

    public function getDuties(): array
    {
        return $this->formData['duties'] ?? [];
    }

    private function setDefaultValues(array $data): array
    {

        $schemalessAttributes = [
            new ApplicantFamilyAttribute,
            new ApplicantEducationAttribute,
            new ApplicantEmergencyAttribute,
            new ApplicantPersonalDocumentsAttribute,
            new ApplicantPreferenceAttribute,
            new HolidayArrangementAttribute,
        ];

        $temp = collect($schemalessAttributes)->reduce(function (array $carry, SetSchemalessAttribute $attributeConverter) use ($data) {

            $carry[$attributeConverter->getGroupName()] = $attributeConverter->extractAttributes($data);

            return $carry;

        }, []);

        $filterKeys = collect($schemalessAttributes)
            ->reduce(fn(array $carry, SetSchemalessAttribute $attributeConverter) => $carry + $attributeConverter->getAtrributes(), []);

        $sourceKeys = array_keys($data);

        $requiredKeys = array_diff($sourceKeys, $filterKeys);


        $otherInputs = collect($data)->reduce(function ($carry, $val, $key) use ($requiredKeys) {
            if (in_array($key, $requiredKeys))
                $carry[$key] = $val;
            return $carry;
        }, []);

        $temp = $temp + $otherInputs;

        $temp['ref_number'] = $data['ref_number'] ?? rand(100000, 999999);
        $temp['vcac_number'] = $data['vcac_number'] ?? rand(100000, 999999);

        $temp['current_country'] = $data['current_country'] ?? "Hong Kong";
        $temp['nationality'] = $data['nationality'] ?? "Filipino";
        $temp['given_name'] = $data['given_name'] ?? $data['name'];

        $temp['hk_code'] = $data['hk_code'] ?? $this->getHKCode();
        $temp['pt_code'] = $data['pt_code'] ?? $this->getPTCode();
        $temp['location'] = $data['current_country'];
        $temp['sex'] = $data['gender'];
        $temp['status'] = $data['status'] ?? ApplicantStatus::Active->value;


        return $temp;

    }

    private function getHKCode()
    {
        return Str::random();
    }

    private function getPTCode()
    {
        return Str::random();
    }

    /**
     * @param $carry
     * @param $val
     * @param $key
     * @return mixed
     */
    function setToAttributeGroup($carry, $group, $val, $key): mixed
    {
        if (!isset($carry[$group])) {
            $carry[$group] = [];
        }
        $carry[$group][$key] = $val;
        return $carry;
    }
}
