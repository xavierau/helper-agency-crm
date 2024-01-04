<?php

namespace Modules\AgencyCore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellableVariantStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'variants.*' => [
                Rule::exists('variants',
                             'id')->where(function($q) {
                    return $q->whereNotIn('id',
                                          $this->sellable->variants->pluck('id')->toArray());
                }),
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
