<?php

namespace Modules\AgencyCore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\AgencyCore\Validators\ApplicantExperienceValidator;

class ApplicantExperienceStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return (new ApplicantExperienceValidator)->getRules();
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
