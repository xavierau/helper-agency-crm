<?php

namespace Modules\AgencyContractDate\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Entities\ContractType;

/**
 * Modules\AgencyContractDate\Entities\ContractDate
 *
 * @property int                                                          $id
 * @property string                                                       $label
 * @property \Illuminate\Support\Carbon|null                              $created_at
 * @property \Illuminate\Support\Carbon|null                              $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Contract[]     $contract
 * @property-read int|null                                                $contract_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ContractType[] $contractDateSet
 * @property-read int|null                                                $contract_date_set_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ContractType[] $contractTypes
 * @property-read int|null                                                $contract_types_count
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDate whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDate whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $group
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDate whereGroup($value)
 */
class ContractDate extends Model
{
    protected $table = 'contract_dates';
    protected $fillable = [
        'label',
        'group',
    ];

    // region Relation
    public function contractDateSet(): BelongsToMany {
        return $this->belongsToMany(ContractType::class)
                    ->using(contractDateSet::class)
                    ->withTimestamps();
    }

    public function contract(): BelongsToMany {
        return $this->belongsToMany(Contract::class)
                    ->using(ContractDateValue::class)
                    ->withTimestamps();
    }

    public function contractTypes(): BelongsToMany {
        return $this->belongsToMany(ContractType::class,
                                    'contract_date_set')
                    ->withPivot('is_required',
                                'order')
                    ->using(ContractDateSet::class)
                    ->as('assignment')
                    ->orderBy('pivot_order');;
    }

    // endregion
}
