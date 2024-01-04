<?php

namespace Modules\AgencyCore\Services;

class DefaultDomesticDuties
{
    public static function get(): array
    {

        return [
            ["label" => "Care of elderly"],
            ["label" => "Care of baby"],
            ["label" => "Gardening"],
            ["label" => "Care of pet"],
            ["label" => "Care of disabled"],
            ["label" => "Care of toddler"],
            ["label" => "Cooking"],
            ["label" => "Household work"],
            ["label" => "Care of bedridden"],
            ["label" => "Care of child"],
            ["label" => "Driving"],
            ["label" => "Car washing"],
        ];
    }
}
