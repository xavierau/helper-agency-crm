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
 * @Date        : 18/1/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\Services;


use Carbon\Carbon;
use Spatie\Period\Period;

class Horoscope
{

    const ZODIAC_SIGNS = [
        [
            'name'  => 'Aquarius',
            'start' => '%s-01-20',
            'end'   => '%s-02-18',
        ],
        [
            'name'  => 'Pisces',
            'start' => '%s-02-19',
            'end'   => '%s-03-20',
        ],
        [
            'name'  => 'Aries',
            'start' => '%s-03-21',
            'end'   => '%s-04-19',
        ],
        [
            'name'  => 'Taurus',
            'start' => '%s-04-20',
            'end'   => '%s-05-20',
        ],
        [
            'name'  => 'Gemini',
            'start' => '%s-05-21',
            'end'   => '%s-06-20',
        ],
        [
            'name'  => 'Cancer',
            'start' => '%s-06-21',
            'end'   => '%s-07-22',
        ],
        [
            'name'  => 'Leo',
            'start' => '%s-07-23',
            'end'   => '%s-08-22',
        ],
        [
            'name'  => 'Virgo',
            'start' => '%s-08-23',
            'end'   => '%s-09-22',
        ],
        [
            'name'  => 'Libra',
            'start' => '%s-09-23',
            'end'   => '%s-10-22',
        ],
        [
            'name'  => 'Scorpio',
            'start' => '%s-10-23',
            'end'   => '%s-11-21',
        ],
        [
            'name'  => 'Sagittarius',
            'start' => '%s-11-22',
            'end'   => '%s-12-21',
        ],
        [
            'name'  => 'Capricorn',
            'start' => '%s-12-22',
            'end'   => '%s-12-31',
        ],
        [
            'name'  => 'Capricorn',
            'start' => '%s-01-01',
            'end'   => '%s-01-19',
        ],
    ];

    public static function get(Carbon $birthDate): string
    {

        $horoscope = '';

        foreach (static::ZODIAC_SIGNS as $sign) {
            $startDate = sprintf($sign['start'], $birthDate->year);
            $endDate = sprintf($sign['end'], $birthDate->year);
            if(Period::make($startDate, $endDate)->contains($birthDate)){
                $horoscope = $sign['name'];
                break;
            }
        }

        return $horoscope;
    }

}
