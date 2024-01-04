<?php

namespace Modules\AgencyCore\Validators;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ApplicantExperienceValidator
{

    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            "age_of_adult"       => ["nullable"],
            "age_of_children"    => ["nullable"],
            "age_of_elderly"     => ["nullable"],
            "description"        => ["nullable"],
            "duties"             => ["nullable"],
            "duties.*"           => ["nullable", "exists:domestic_duties,id"],
            "from"               => ["nullable", "date"],
            "house_size"         => ["nullable"],
            "location"           => ["nullable"],
            "number_of_adult"    => ["nullable"],
            "number_of_children" => ["nullable"],
            "number_of_elderly"  => ["nullable"],
            "position"           => ["nullable"],
            "status"             => ["required"],
            "to"                 => ["nullable", "date"],
            "uuid"               => ["nullable"],
            "reason"             => ["nullable"],
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
