<?php

namespace Modules\AgencyCore\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modules\AgencyCore\Entities\Personality
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Job[] $jobs
 * @property-read int|null $jobs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Personality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Personality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Personality query()
 * @mixin \Eloquent
 */
class Personality extends Model
{
    protected $fillable = [];

    // region Relation

    public function jobs(): BelongsToMany {
        return $this->belongsToMany(Job::class);
    }

    // endregion
}
