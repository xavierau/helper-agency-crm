<?php

namespace Modules\AgencyCore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantBasicInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'given_name'          => ['nullable', 'string', 'max:255'],
            'surname'             => ['nullable', 'string', 'max:255'],
            'middle_name'         => ['nullable', 'string', 'max:255'],
            'date_of_birth'       => ['nullable', 'date', 'required'],
            'height'              => ['nullable', 'numeric', 'min:0'],
            'weight'              => ['nullable', 'numeric', 'min:0'],
            'marital_status'      => ['nullable'],
            'gender'              => ['in:male,female'],
            'nationality'         => ['nullable'],
            'family'              => ['nullable'],
            'education'           => ['nullable'],
            'holiday_arrangement' => ['nullable'],
            'duties'              => ['nullable'],
            'date_of_release'     => ['nullable', 'date'],

            'questions'                      => ['nullable'],
            'questions.change_name'          => ['required', 'boolean'],
            'questions.change_name_info'     => ['nullable'],
            'questions.has_been_deport'      => ['required', 'boolean'],
            'questions.has_been_deport_info' => ['nullable'],
            'questions.reject_visa'          => ['required', 'boolean'],
            'questions.reject_visa_info'     => ['nullable'],
            'questions.afraid_of_dog'        => ['nullable', 'boolean'],
            'questions.eat_pork'             => ['nullable', 'boolean'],
            'questions.smoke_and_drink'      => ['nullable', 'boolean'],

            'english'   => ['nullable'],
            'cantonese' => ['nullable'],
            'mandarin'  => ['nullable'],

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
