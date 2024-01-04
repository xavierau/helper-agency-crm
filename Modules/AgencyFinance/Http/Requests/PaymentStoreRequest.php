<?php

namespace Modules\AgencyFinance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\AgencyFinance\Enums\CreditNoteStatus;

class PaymentStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'invoice_id'     => 'required|exists:invoices,id',
            'credit_note_id' => [
                'nullable',
                Rule::exists('credit_notes',
                             'id')->where(function($q) {
                    return $q->where('status',
                                     CreditNoteStatus::ACTIVE());
                }),
            ],
            'amount'         => 'required|numeric',
            'attachment'     => 'nullable|file',
            'note'           => 'nullable',
            'type'           => 'required',
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
