<?php

namespace Modules\AgencyContractDoc\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\AgencyContract\Entities\ContractType;

/**
 * Modules\AgencyContractDoc\Entities\ContractDocSet
 *
 * @property int                                                  $id
 * @property int                                                  $contract_doc_id
 * @property int                                                  $contract_type_id
 * @property bool                                                 $is_required
 * @property int                                                  $order
 * @property \Illuminate\Support\Carbon|null                      $created_at
 * @property \Illuminate\Support\Carbon|null                      $updated_at
 * @property-read \Modules\AgencyContractDoc\Entities\ContractDoc $doc
 * @property-read ContractType                                    $type
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet whereContractDocId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet whereContractTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocSet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContractDocSet extends Pivot
{
    protected $table = 'contract_doc_sets';
    protected $fillable = [
        'contract_type_id',
        'contract_doc_id',
        'order',
        'is_required',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    // region Relation

    public function doc(): BelongsTo {
        return $this->belongsTo(ContractDoc::class,
                                'contract_doc_id');
    }

    public function type(): BelongsTo {
        return $this->belongsTo(ContractType::class,
                                'contract_type_id');
    }
    // endregion
}
