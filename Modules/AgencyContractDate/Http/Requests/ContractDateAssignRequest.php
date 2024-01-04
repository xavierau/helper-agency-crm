<?php

namespace Modules\AgencyContractDate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractDateAssignRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'order'            => 'required|numeric',
            'is_required'      => 'required|boolean',
            'contract_type_id' => 'required|exists:contract_types,id',
            'contract_date_id' => 'required|exists:contract_dates,id',
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
