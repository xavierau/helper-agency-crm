<?php

namespace Modules\AgencyTemplate\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Modules\AgencyTemplate\Entities\Template
 *
 * @property int $id
 * @property string|null $label
 * @property string $view_path
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $entity
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereViewPath($value)
 * @mixin \Eloquent
 */
class Template extends Model
{
    protected $fillable = [
        'label',
        'tags',
        'view_path',
        'entity_id',
        'entity_type',
    ];

    // region Relation

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    // endregion

}
