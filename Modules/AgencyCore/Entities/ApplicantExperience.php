<?php

namespace Modules\AgencyCore\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modules\AgencyCore\Entities\ApplicantExperience
 *
 * @property int $id
 * @property string|null $location
 * @property string|null $position
 * @property \Illuminate\Support\Carbon|null $from
 * @property \Illuminate\Support\Carbon|null $to
 * @property int|null $house_size
 * @property int|null $number_of_adult
 * @property string|null $age_of_adult
 * @property int|null $number_of_children
 * @property string|null $age_of_children
 * @property int|null $number_of_elderly
 * @property string|null $age_of_elderly
 * @property string|null $duties
 * @property string $status
 * @property int $applicant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\AgencyCore\Entities\Applicant $applicant
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereAgeOfAdult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience
 *         whereAgeOfChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience
 *         whereAgeOfElderly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience
 *         whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereDuties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereHouseSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience
 *         whereNumberOfAdult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience
 *         whereNumberOfChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience
 *         whereNumberOfElderly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $region
 * @property string|null $description
 * @property-read int|null $duties_count
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantExperience whereRegion($value)
 */
class ApplicantExperience extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'from' => 'date',
        'to'   => 'date',
    ];

    //region: Relation
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function duties(): BelongsToMany
    {
        return $this->BelongsToMany(
            DomesticDuty::class,
            'applicant_experience_domestic_duty',
            'experience_id',
            'duty_id',
        );
    }

    //endregion

    // region Helpers

    public function profileDuties(): string
    {
        return implode(", ", $this->duties->reduce(function ($carry, $duty) {
            $carry[] = ucwords(__($duty->label));
            return $carry;
        }, []));
    }

    // endregion
}
