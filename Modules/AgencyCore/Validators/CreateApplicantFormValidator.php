<?php

namespace Modules\AgencyCore\Validators;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CreateApplicantFormValidator
{


    /**
     * @return array
     */
    public function getRules(): array
    {
        $experienceRules = collect((new ApplicantExperienceValidator)->getRules())
            ->reduce(function ($carry, $value, $key) {
                $carry["experience.*.{$key}"] = $value;

                return $carry;

            }, []);

        return [

            "age_of_daughters"           => ["nullable"],
            "age_of_sons"                => ["nullable"],
            "date_of_release"            => ["nullable", "date"],
            "cantonese"                  => ["nullable"],
            "current_country"            => ["nullable"],
            "date_of_birth"              => ["nullable", "date"],
            "duties"                     => ["nullable", "exists:domestic_duties,id"],
            "email"                      => ["nullable"],
            "english"                    => ["nullable"],
            "facebook"                   => ["nullable"],
            "father_age"                 => ["nullable"],
            "father_name"                => ["nullable"],
            "father_occupation"          => ["nullable"],
            "gender"                     => ["nullable"],
            "height"                     => ["nullable"],
            "mandarin"                   => ["nullable"],
            "marital_status"             => ["nullable"],
            "mother_age"                 => ["nullable"],
            "mother_name"                => ["nullable"],
            "mother_occupation"          => ["nullable"],
            "name"                       => ["nullable"],
            "nationality"                => ["nullable"],
            "number_in_family"           => ["nullable"],
            "number_of_brothers"         => ["nullable"],
            "number_of_daughters"        => ["nullable"],
            "number_of_sisters"          => ["nullable"],
            "number_of_sons"             => ["nullable"],
            "other_language"             => ["nullable"],
            "phone"                      => ["nullable"],
            "spouse_age"                 => ["nullable"],
            "spouse_name"                => ["nullable"],
            "spouse_occupation"          => ["nullable"],
            "weight"                     => ["nullable"],
            'address'                    => ['nullable'],
            'age_of_boy'                 => ['nullable'],
            'age_of_girl'                => ['nullable'],
            'emergency_contact_name'     => ['nullable'],
            'emergency_contact_number'   => ['nullable'],
            'emergency_contact_relation' => ['nullable'],
            'experience'                 => ['nullable'],
            'given_name'                 => ['nullable'],
            'graduation_year'            => ['nullable'],
            'highest_education'          => ['nullable'],
            'hk_code'                    => ['nullable'],
            'hkid'                       => ['nullable'],
            'horoscope'                  => ['nullable'],
            'location'                   => ['nullable'],
            'major'                      => ['nullable'],
            'middle_name'                => ['nullable'],
            'number_of_boy'              => ['nullable'],
            'number_of_children'         => ['nullable'],
            'number_of_girl'             => ['nullable'],
            'passport_expiry_date'       => ['nullable'],
            'passport_issued_date'       => ['nullable'],
            'passport_number'            => ['nullable'],
            'place_of_issue'             => ['nullable'],
            'position_in_family'         => ['nullable'],
            'pt_code'                    => ['nullable'],
            'religion'                   => ['nullable'],
            'school_name'                => ['nullable'],
            'sex'                        => ['nullable'],
            'supplier_id'                => ['nullable'],
            'surname'                    => ['nullable'],
            'zodiac'                     => ['nullable'],
            'sunday'                     => ['nullable', 'boolean'],
            'alternative'                => ['nullable', 'boolean'],
            'weekday'                    => ['nullable', 'boolean'],
            'no_holidays'                => ['nullable', 'boolean'],
            'once_a_month'               => ['nullable', 'boolean'],

            'questions'                      => ['nullable'],
            'questions.change_name'          => ['required', 'boolean'],
            'questions.change_name_info'     => ['nullable'],
            'questions.has_been_deport'      => ['required', 'boolean'],
            'questions.has_been_deport_info' => ['nullable'],
            'questions.reject_visa'          => ['required', 'boolean'],
            'questions.reject_visa_info'     => ['nullable'],
            'questions.afraid_of_dog'        => ['nullable', 'boolean'],
            'questions.smoke_and_drink'      => ['nullable', 'boolean'],
            'questions.eat_pork'             => ['nullable', 'boolean'],

            ...$experienceRules
        ];
    }


    /**
     * @throws ValidationException
     */
    public
    function validated(array $data): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make(
            $data,
            $this->getRules(),
        );

        return $validator->validated();

    }


}
