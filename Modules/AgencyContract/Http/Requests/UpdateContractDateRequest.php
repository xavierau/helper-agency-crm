<?php

namespace Modules\AgencyContract\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractDateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'contract_date_id' => 'required|exists:contract_dates,id',
            'value'            => 'required|date',
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
