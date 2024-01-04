<?php

namespace Modules\AgencyCore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\AgencyCore\Entities\Requirement;

class ClientJobStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'service_type'       => 'required|in:people,other',
            'people.type'        => 'in:local,overseas,no_preference',
            'people.note'        => 'nullable',
            'people.nationality' => 'nullable',
            'other.services'     => 'nullable',
            'other.note'         => 'nullable',
        ];

        $rules = $this->addRequirementRules($rules);

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    private function addRequirementRules(array $rules) {

        $requirementRules = Requirement::GetValidationRules();

        $keys = array_map(fn($k) => "people.{$k}",
            array_keys($requirementRules));

        return $rules + array_combine($keys,
                                      array_values($requirementRules));
    }
}
