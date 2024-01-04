<?php

namespace Modules\AgencyCore\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\AgencyContract\Entities\Contract;

/**
 * Modules\AgencyCore\Entities\Job
 *
 * @property int
 *              $id
 * @property string
 *              $service_type
 * @property string
 *              $type
 * @property string|null
 *              $nationality
 * @property string
 *              $status
 * @property array|null
 *              $services
 * @property string|null
 *              $note
 * @property int
 *              $client_id
 * @property int
 *              $account_id
 * @property \Illuminate\Support\Carbon|null
 *              $created_at
 * @property \Illuminate\Support\Carbon|null
 *              $updated_at
 * @property-read \Modules\AgencyCore\Entities\Account
 *                   $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Applicant[]
 *                   $applicants
 * @property-read int|null
 *                   $applicants_count
 * @property-read \Modules\AgencyCore\Entities\Client
 *                   $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\DomesticDuty[]
 *                $duties
 * @property-read int|null
 *                   $duties_count
 * @property-read string
 *                   $client_name
 * @method static Builder|Job clientName($keyword = null)
 * @method static Builder|Job newModelQuery()
 * @method static Builder|Job newQuery()
 * @method static Builder|Job query()
 * @method static Builder|Job requestWith($keyword = null)
 * @method static Builder|Job search($keyword = null)
 * @method static Builder|Job status($keyword = null)
 * @method static Builder|Job whereAccountId($value)
 * @method static Builder|Job whereClientId($value)
 * @method static Builder|Job whereCreatedAt($value)
 * @method static Builder|Job whereId($value)
 * @method static Builder|Job whereNationality($value)
 * @method static Builder|Job whereNote($value)
 * @method static Builder|Job whereServiceType($value)
 * @method static Builder|Job whereServices($value)
 * @method static Builder|Job whereStatus($value)
 * @method static Builder|Job whereType($value)
 * @method static Builder|Job whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null                                   $house_size
 * @property int|null                                   $number_of_rooms
 * @property int|null                                   $garden_size
 * @property int|null                                   $number_of_cars
 * @property int|null                                   $number_of_expecting_babies
 * @property int|null                                   $number_of_kids
 * @property int|null                                   $number_of_young_adult
 * @property array                                      $age_of_kids
 * @property array                                      $age_of_young_adults
 * @property array                                      $age_of_adults
 * @property array                                      $age_of_elders
 * @property int|null                                   $number_of_adults
 * @property int|null                                   $number_of_elders
 * @property int|null                                   $disabled_personnel
 * @property array                                      $pets
 * @property string|null                                $dayoff_arrangement
 * @property string|null                                $accommodation_type
 * @property int|null                                   $accommodation_value
 * @property string|null                                $special_duties
 * @property int|null                                   $contract_id
 * @property int|null                                   $job_id
 * @property-read Contract|null                         $contract
 * @property-read \Modules\AgencyCore\Entities\Job|null $job
 * @method static Builder|Requirement whereAccommodationType($value)
 * @method static Builder|Requirement whereAccommodationValue($value)
 * @method static Builder|Requirement whereAgeOfAdults($value)
 * @method static Builder|Requirement whereAgeOfElders($value)
 * @method static Builder|Requirement whereAgeOfKids($value)
 * @method static Builder|Requirement whereAgeOfYoungAdults($value)
 * @method static Builder|Requirement whereContractId($value)
 * @method static Builder|Requirement whereDayoffArrangement($value)
 * @method static Builder|Requirement whereDisabledPersonnel($value)
 * @method static Builder|Requirement whereGardenSize($value)
 * @method static Builder|Requirement whereHouseSize($value)
 * @method static Builder|Requirement whereJobId($value)
 * @method static Builder|Requirement whereNumberOfAdults($value)
 * @method static Builder|Requirement whereNumberOfCars($value)
 * @method static Builder|Requirement whereNumberOfElders($value)
 * @method static Builder|Requirement whereNumberOfExpectingBabies($value)
 * @method static Builder|Requirement whereNumberOfKids($value)
 * @method static Builder|Requirement whereNumberOfRooms($value)
 * @method static Builder|Requirement whereNumberOfYoungAdult($value)
 * @method static Builder|Requirement wherePets($value)
 * @method static Builder|Requirement whereSpecialDuties($value)
 * @property \datetime|null $expected_arrival_date
 * @property int|null $number_of_young_adults
 * @method static Builder|Requirement whereExpectedArrivalDate($value)
 * @method static Builder|Requirement whereNumberOfYoungAdults($value)
 */
class Requirement extends Model
{
    protected $fillable = [
        'expected_arrival_date',
        'house_size',
        'number_of_rooms',
        'garden_size',
        'number_of_cars',
        'number_of_expecting_babies',
        'number_of_kids',
        'number_of_young_adults',
        'age_of_kids',
        'age_of_young_adults',
        'age_of_adults',
        'age_of_elders',
        'number_of_adults',
        'number_of_elders',
        'disabled_personnel',
        'pets',
        'dayoff_arrangement',
        'accommodation_type',
        'accommodation_value',
        'special_duties',
        'note',
    ];

    protected $casts = [
        'expected_arrival_date' => 'datetime:Y-m-d',
    ];


    // region Relation

    public function contract(): BelongsTo {
        return $this->belongsTo(Contract::class);
    }

    public function job(): BelongsTo {
        return $this->belongsTo(Job::class);
    }

    //endregion

    // region Mutation

    public function setAgeOfKidsAttribute($value): void {
        $this->attributes['age_of_kids'] = json_encode($value);
    }

    public function setAgeOfYoungAdultsAttribute($value): void {
        $this->attributes['age_of_young_adults'] = json_encode($value);
    }

    public function setAgeOfAdultsAttribute($value): void {
        $this->attributes['age_of_adults'] = json_encode($value);
    }

    public function setAgeOfEldersAttribute($value): void {
        $this->attributes['age_of_elders'] = json_encode($value);
    }

    public function setPetsAttribute($value): void {
        $this->attributes['pets'] = json_encode($value);
    }

    // endregion

    // region Accessor
    public function getAgeOfKidsAttribute($value): array {
        return json_decode($value,
                           true);
    }

    public function getAgeOfYoungAdultsAttribute($value): array {
        return json_decode($value,
                           true);
    }

    public function getAgeOfAdultsAttribute($value): array {
        return json_decode($value,
                           true);
    }

    public function getAgeOfEldersAttribute($value): array {
        return json_decode($value,
                           true);
    }

    public function getPetsAttribute($value): array {
        return json_decode($value,
                           true);
    }

    // endregion

    public static function GetValidationRules(): array {
        return [
            'expected_arrival_date'      => 'nullable|date',
            'house_size'                 => 'nullable|integer|min:0',
            'number_of_rooms'            => 'nullable|integer|min:0',
            'garden_size'                => 'nullable|integer|min:0',
            'number_of_cars'             => 'nullable|integer|min:0',
            'number_of_expecting_babies' => 'nullable|integer|min:0',
            'number_of_kids'             => 'nullable|integer|min:0',
            'number_of_young_adults'     => 'nullable|integer|min:0',
            'age_of_kids'                => 'nullable',
            'age_of_young_adults'        => 'nullable',
            'age_of_adults'              => 'nullable',
            'age_of_elders'              => 'nullable',
            'number_of_adults'           => 'nullable|integer|min:0',
            'number_of_elders'           => 'nullable|integer|min:0',
            'disabled_personnel'         => 'nullable|integer|min:0',
            'pets'                       => 'nullable',
            'dayoff_arrangement'         => 'nullable',
            'accommodation_type'         => 'nullable|in:alone,shared',
            'accommodation_value'        => 'nullable',
            'special_duties'             => 'nullable',
            'note'                       => 'nullable',
        ];
    }
}
