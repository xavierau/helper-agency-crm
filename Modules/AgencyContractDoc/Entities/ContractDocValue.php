<?php

namespace Modules\AgencyContractDoc\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\AgencyContract\Entities\Contract;

/**
 * Modules\AgencyContractDoc\Entities\ContractDocValue
 *
 * @property int $id
 * @property int $contract_doc_id
 * @property int $contract_id
 * @property string|null $value
 * @property string|null $mime_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Contract $contract
 * @property-read \Modules\AgencyContractDoc\Entities\ContractDoc $doc
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue whereContractDocId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocValue whereValue($value)
 * @mixin \Eloquent
 */
class ContractDocValue extends Pivot
{
    protected $table = 'contract_doc_values';

    // region Relation

    public function doc(): BelongsTo {
        return $this->belongsTo(ContractDoc::class);
    }

    public function contract(): BelongsTo {
        return $this->belongsTo(Contract::class);

    }

    // endregion

}
