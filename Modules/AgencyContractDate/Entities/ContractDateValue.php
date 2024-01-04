<?php

namespace Modules\AgencyContractDate\Entities;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\AgencyContract\Entities\Contract;

/**
 * Modules\AgencyContractDate\Entities\ContractDateValue
 *
 * @property int $id
 * @property int $contract_id
 * @property int $contract_date_id
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Contract $contract
 * @property-read \Modules\AgencyContractDate\Entities\ContractDate $date
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateValue whereContractDateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateValue whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDateValue whereValue($value)
 * @mixin \Eloquent
 */
class ContractDateValue extends Pivot
{
    protected $table = 'contract_date_values';

    // region Relation

    public function date(): BelongsTo {
        return $this->belongsTo(ContractDate::class);
    }

    public function contract(): BelongsTo {
        return $this->belongsTo(Contract::class);

    }

    // endregion
}
