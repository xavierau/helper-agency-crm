<?php

namespace Modules\AgencyCore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hk_code'        => ['nullable'],
            'pt_code'        => ['nullable'],
            'supplier_id'    => ['nullable', 'exists:suppliers,id'],
            'location'       => ['nullable'],
            'surname'        => ['nullable'],
            'middle_name'    => ['nullable'],
            'given_name'     => ['nullable'],
            'height'         => ['nullable'],
            'weight'         => ['nullable'],
            'nationality'    => ['nullable'],
            'gender'         => ['nullable'],
            'marital_status' => ['nullable'],
            'date_of_birth'  => ['nullable', 'date'],
            'religion'       => ['nullable'],
            'address'        => ['nullable'],
            'mobile'         => ['nullable'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
