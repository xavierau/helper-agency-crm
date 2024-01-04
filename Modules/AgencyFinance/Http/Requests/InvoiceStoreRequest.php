<?php

namespace Modules\AgencyFinance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\AgencyContract\Entities\Contract;

class InvoiceStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'client.id' => 'required|exists:clients,id',

            'note'                     => 'nullable',
            'discount'                 => 'nullable|numeric',
            'contract.id'              => [
                'required',
                Rule::in(array_merge(['new'],
                                     Contract::pluck('id')->toArray())),
            ],
            'contract.contract_number' => 'required_if:contract.id,new|unique:contracts,contract_number',
            'contract.applicant.id'    => 'required_if:contract.id,new|exists:applicants,id',
            'contract.job_id'          => 'nullable|exists:jobs,id',
            'contract.internal_code'   => 'required',
            // TODO:: check applicant status
            // TODO:: check variant is within sellable status
            'invoice.id'               => [
                'sometimes',
                Rule::exists('invoices',
                             'id')
                    ->where(function($query) {
                        return $query->where('client_id',
                                             [$this->client]['id'])
                                     ->where('status',
                                             'active');
                    }),
            ],
            'items.*'                  => 'nullable|required_without:invoice_id,',
            'items.*.sellable_id'      => 'required|exists:sellables,id',
            'items.*.discount'         => 'nullable|numeric',
            'items.*.price'            => 'required|numeric',
            'items.*.qty'              => 'required|numeric|min:1',
            'items.*.note'             => 'nullable',
            'items.*.variant_id'       => [
                'nullable',
            ],
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
