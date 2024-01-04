<?php

namespace Modules\AgencyCore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\AgencyCore\Validators\CreateApplicantFormValidator;

class ApplicantStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return (new CreateApplicantFormValidator())->getRules();


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
