<?php

namespace Modules\AgencyCore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellableVariantUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'pivot.price'       => 'required|numeric|min:0',
            'pivot.inventory'   => 'nullable|numeric|min:0',
            'pivot.is_active'   => 'required|boolean',
            'pivot.description' => 'nullable',
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

    public function validated() {
        return [
            'price'       => $this->get('pivot')['price'],
            'is_active'   => $this->get('pivot')['is_active'],
            'inventory'   => $this->get('pivot')['inventory'],
            'description' => $this->get('pivot')['description'],
        ];
    }
}
