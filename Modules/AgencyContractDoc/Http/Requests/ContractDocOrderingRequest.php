<?php

namespace Modules\AgencyContractDoc\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractDocOrderingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'contract_type_id'  => 'required|exists:contract_types,id',
            'contract_doc_1_id' => 'required|exists:contract_docs,id',
            'contract_doc_2_id' => 'required|exists:contract_docs,id',
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
