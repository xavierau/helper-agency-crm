<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package
 * @Date        : 20/12/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\DataTransferObject;


use Carbon\Carbon;

class RequirementData
{
    private ?string $expected_arrival_date = null;
    private ?int $house_size = null;
    private ?int $number_of_rooms = null;
    private ?int $garden_size = null;
    private ?int $number_of_cars = null;
    private array $age_of_kids = [];
    private array $age_of_young_adults = [];
    private array $age_of_adults = [];
    private array $age_of_elders = [];
    private ?int $number_of_expecting_babies = null;
    private ?int $number_of_kids = null;
    private ?int $number_of_young_adult = null;
    private int $number_of_adults = 0;
    private int $number_of_elders = 0;
    private int $disabled_personnel = 0;
    private array $pets = [];
    private ?string $dayoff_arrangement = null;
    private ?string $accommodation_type = null;
    private ?string $accommodation_value = null;
    private ?string $special_duties = null;
    private ?string $note = null;

    public static function fromFormData(array $data): RequirementData {

        $instance = new static;

        $instance->house_size = $data['house_size'] ?? null;
        $instance->number_of_rooms = $data['number_of_rooms'] ?? null;
        $instance->garden_size = $data['garden_size'] ?? null;
        $instance->number_of_cars = $data['number_of_cars'] ?? null;
        $instance->number_of_expecting_babies = $data['number_of_expecting_babies'] ?? null;
        $instance->number_of_kids = $data['number_of_kids'] ?? null;
        $instance->number_of_young_adults = $data['number_of_young_adults'] ?? null;
        $instance->age_of_kids = self::getArrayData($data,
                                                    'age_of_kids');
        $instance->age_of_young_adults = self::getArrayData($data,
                                                            'age_of_young_adults');
        $instance->age_of_adults = self::getArrayData($data,
                                                      'age_of_adults');

        $instance->age_of_elders = self::getArrayData($data,
                                                      'age_of_elders');
        $instance->number_of_adults = $data['number_of_adults'] ?? 0;
        $instance->number_of_elders = $data['number_of_elders'] ?? 0;
        $instance->disabled_personnel = $data['disabled_personnel'] ?? 0;
        $instance->pets = self::getArrayData($data,
                                             'pets');
        $instance->dayoff_arrangement = $data['dayoff_arrangement'] ?? null;
        $instance->accommodation_type = $data['accommodation_type'] ?? null;
        $instance->accommodation_value = $data['accommodation_value'] ?? null;
        $instance->special_duties = $data['special_duties'] ?? null;
        $instance->note = $data['note'] ?? null;
        $instance->expected_arrival_date = $data['expected_arrival_date'] ?? null;

        return $instance;
    }

    /**
     * @param array  $data
     * @param string $key
     * @return array
     */
    private static function getArrayData(array $data, string $key): array {

        if(( !isset($data[$key]) or $data[$key] === null)) {
            return [];
        }

        if(is_array($data[$key])) {
            return array_map('trim',
                             $data[$key]);
        }

        return array_map('trim',
                         explode(',',
                                 $data[$key]));

    }

    public function getRequirementData(): array {
        $data = [
            "house_size"                 => $this->house_size,
            "number_of_rooms"            => $this->number_of_rooms,
            "garden_size"                => $this->garden_size,
            "number_of_cars"             => $this->number_of_cars,
            "age_of_kids"                => $this->age_of_kids,
            "age_of_young_adults"        => $this->age_of_young_adults,
            "age_of_adults"              => $this->age_of_adults,
            "age_of_elders"              => $this->age_of_elders,
            "number_of_expecting_babies" => $this->number_of_expecting_babies,
            "number_of_kids"             => $this->number_of_kids,
            "number_of_young_adults"     => $this->number_of_young_adults,
            "number_of_adults"           => $this->number_of_adults,
            "number_of_elders"           => $this->number_of_elders,
            "disabled_personnel"         => $this->disabled_personnel,
            "pets"                       => $this->pets,
            "dayoff_arrangement"         => $this->dayoff_arrangement,
            "accommodation_type"         => $this->accommodation_type,
            "accommodation_value"        => $this->accommodation_value,
            "special_duties"             => $this->special_duties,
            "note"                       => $this->note,
        ];

        try {
            $data['expected_arrival_date'] = $this->expected_arrival_date !== null ?
                Carbon::parse($this->expected_arrival_date): null;
        } finally {
            return $data;
        }
    }

}
