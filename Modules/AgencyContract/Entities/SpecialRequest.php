<?php

namespace Modules\AgencyContract\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modules\AgencyContract\Entities\SpecialRequest
 *
 * @property-read \Modules\AgencyContract\Entities\Contract $contract
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialRequest query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $content
 * @property int $contract_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialRequest whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialRequest whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialRequest whereUpdatedAt($value)
 */
class SpecialRequest extends Model
{
    protected $fillable = ['content'];

    // region Relation

    public function contract(): BelongsTo {
        return $this->belongsTo(Contract::class);
    }

    // endregion
}
