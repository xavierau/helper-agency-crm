<?php

namespace Modules\AgencyContractDoc\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyContractDate\Entities\ContractDateSet;
use Modules\AgencyContractDate\Entities\ContractDateValue;

/**
 * Modules\AgencyContractDoc\Entities\ContractDoc
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
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDoc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDoc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDoc query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDoc whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDoc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDoc whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDoc whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $group
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDoc whereGroup($value)
 */
class ContractDoc extends Model
{
    protected $table = 'contract_docs';
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
                    ->using(ContractDocSet::class)
                    ->as('assignment')
                    ->orderBy('pivot_order');;
    }

    // endregion
}
