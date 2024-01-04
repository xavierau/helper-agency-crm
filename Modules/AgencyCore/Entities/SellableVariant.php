<?php

namespace Modules\AgencyCore\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\AgencyTemplate\Contracts\HasTemplateInterface;
use Modules\AgencyTemplate\Traits\HasTemplate;

/**
 * Modules\AgencyCore\Entities\SellableVariant
 *
 * @property int $id
 * @property float|null $price
 * @property float|null $inventory
 * @property bool $is_active
 * @property string|null $description
 * @property int $sellable_id
 * @property int $variant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyTemplate\Entities\Template[] $template
 * @property-read \Modules\AgencyCore\Entities\Sellable $sellable
 * @property-read int|null $template_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyTemplate\Entities\Template[] $templates
 * @property-read int|null $templates_count
 * @property-read \Modules\AgencyCore\Entities\Variant $variant
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant query()
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant whereInventory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant whereSellableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellableVariant whereVariantId($value)
 * @mixin \Eloquent
 */
class SellableVariant extends Pivot implements HasTemplateInterface
{
    use HasTemplate;

    protected $fillable = [
        'price',
        'inventory',
        'variant_id',
        'sellable_id',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // region Relation

    public function variant(): BelongsTo {
        return $this->belongsTo(Variant::class);
    }

    public function sellable(): BelongsTo {
        return $this->belongsTo(Sellable::class);
    }

    // endregion
}
