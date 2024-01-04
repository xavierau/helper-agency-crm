<?php

namespace Modules\AgencyContract\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\AgencyContractDate\Entities\ContractDate;
use Modules\AgencyContractDate\Entities\ContractDateSet;
use Modules\AgencyContractDoc\Entities\ContractDoc;
use Modules\AgencyContractDoc\Entities\ContractDocSet;
use Modules\AgencyTemplate\Contracts\HasTemplateInterface;
use Modules\AgencyTemplate\Traits\HasTemplate;

/**
 * Modules\AgencyContract\Entities\ContractType
 *
 * @property int $id
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|ContractDate[] $contractDates
 * @property-read int|null $contract_dates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ContractDoc[] $contractDocuments
 * @property-read int|null $contract_documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyContract\Entities\Contract[] $contracts
 * @property-read int|null $contracts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyTemplate\Entities\Template[] $template
 * @property-read int|null $template_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyTemplate\Entities\Template[] $templates
 * @property-read int|null $templates_count
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContractType extends Model implements HasTemplateInterface
{
    use HasTemplate;

    protected $fillable = [
        'label',
    ];

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function contractDates(): BelongsToMany
    {
        return $this->belongsToMany(ContractDate::class,
            'contract_date_set')
            ->withPivot('is_required',
                'order')
            ->using(ContractDateSet::class)
            ->as('assignment')
            ->orderBy('pivot_order');
    }

    public function contractDocuments(): BelongsToMany
    {
        return $this->belongsToMany(ContractDoc::class,
            'contract_doc_sets')
            ->withPivot('is_required',
                'order')
            ->using(ContractDocSet::class)
            ->as('assignment')
            ->orderBy('pivot_order');
    }

}
