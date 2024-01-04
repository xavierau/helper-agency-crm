<?php

namespace Modules\AgencyCore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'prefix'             => 'nullable',
            'first_name'         => 'nullable',
            'last_name'          => 'nullable',
            'chinese_first_name' => 'nullable',
            'chinese_last_name'  => 'nullable',
            'occupation'         => 'nullable',
            'date_of_birth'      => 'nullable|date',
            'place_of_birth'     => 'nullable',
            'is_male'            => 'nullable|boolean',
            'email'              => 'nullable|email',
            'tel'                => 'nullable',
            'mobile'             => 'nullable',
            'company_name'       => 'nullable',
            'marital_status'     => 'nullable',
            'hk_id'              => 'nullable',
            'nationality'        => 'nullable',
            'client_number'      => 'nullable',
            'is_primary'         => 'nullable|boolean',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
}
