<?php

namespace Modules\AgencyFinance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\AgencyFinance\Rules\InvoiceBelongsToClient;
use Modules\AgencyFinance\Rules\InvoiceItemInInvoice;

class InvoiceUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'client.id'             => 'required|exists:clients,id',
            'note'                  => 'nullable',
            'discount'              => 'nullable|numeric',
            'contract.id'           => [
                'required',
                new InvoiceBelongsToClient,
            ],
            'invoice_id'            => [
                'sometimes',
                'nullable',
                Rule::exists('invoices',
                             'id')
                    ->where(function($query) {
                        return $query->where('client_id',
                                             $this->client_id)
                                     ->where('status',
                                             'superseded');
                    }),
            ],
            'contract.applicant.id' => 'required_if:contract.id,new|exists:applicants,id',
            // TODO:: check applicant status
            // TODO:: check variant is within sellable status
            'items.*'               => 'required',
            'items.*.id'            => ['nullable', new InvoiceItemInInvoice],
            'items.*.sellable_id'   => 'required|exists:sellables,id',
            'items.*.discount'      => 'nullable|numeric',
            'items.*.description'   => 'nullable',
            'items.*.price'         => 'required|numeric',
            'items.*.qty'           => 'required|numeric|min:1',
            'items.*.note'          => 'nullable',
            'items.*.variant_id'    => [
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
