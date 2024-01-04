<?php

namespace Modules\AgencyContractDate\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\AgencyContract\Entities\ContractType;

/**
 * Modules\AgencyContractDate\Entities\ContractDateSet
 *
 * @property int                                                    $id
 * @property int                                                    $contract_type_id
 * @property int                                                    $contract_date_id
 * @property int|null                                               $order
 * @property bool                                                   $is_required
 * @property string|null                                            $created_at
 * @property string|null                                            $updated_at
 * @property-read \Modules\AgencyContractDate\Entities\ContractDate $date
 * @property-read ContractType                                      $type
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet whereContractDateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet whereContractTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateSet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContractDateSet extends Pivot
{
    protected $table = 'contract_date_set';

    protected $fillable = [
        'contract_type_id',
        'contract_date_id',
        'order',
        'is_required',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'order'       => 'integer',
    ];

    public $timestamps = false;

    // region Relation

    public function date(): BelongsTo {
        return $this->belongsTo(ContractDate::class,
                                'contract_date_id');
    }

    public function type(): BelongsTo {
        return $this->belongsTo(ContractType::class,
                                'contract_type_id');
    }
    // endregion
}
