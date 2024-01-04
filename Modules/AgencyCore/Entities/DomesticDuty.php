<?php

namespace Modules\AgencyCore\Entities;

use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modules\AgencyCore\Entities\DomesticDuty
 *
 * @property int $id
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Applicant[] $applicants
 * @property-read int|null $applicants_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Job[] $jobs
 * @property-read int|null $jobs_count
 * @method static \Illuminate\Database\Eloquent\Builder|DomesticDuty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DomesticDuty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DomesticDuty query()
 * @method static \Illuminate\Database\Eloquent\Builder|DomesticDuty requestWith($keyword = null)
 * @method static \Illuminate\Database\Eloquent\Builder|DomesticDuty search($searchColumns, $keyword = null)
 * @method static \Illuminate\Database\Eloquent\Builder|DomesticDuty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DomesticDuty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DomesticDuty whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DomesticDuty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DomesticDuty extends Model
{
    use CommonScopes;

    protected $fillable = [
        'label',
    ];

    public function jobs(): BelongsToMany {
        return $this->BelongsToMany(Job::class);
    }

    public function applicants(): BelongsToMany {
        return $this->BelongsToMany(Applicant::class);
    }
}
