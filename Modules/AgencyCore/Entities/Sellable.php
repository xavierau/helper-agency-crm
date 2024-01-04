<?php

namespace Modules\AgencyCore\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\AgencyTemplate\Contracts\HasTemplateInterface;
use Modules\AgencyTemplate\Entities\Template;
use Modules\AgencyTemplate\Traits\HasTemplate;

/**
 * Modules\AgencyCore\Entities\Sellable
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property float $inventory
 * @property bool $is_active
 * @property bool $editable
 * @property bool $track_inventory
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read bool $has_variants
 * @property-read \Illuminate\Database\Eloquent\Collection|Template[] $template
 * @property-read int|null $template_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Template[] $templates
 * @property-read int|null $templates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Variant[] $variants
 * @property-read int|null $variants_count
 * @method static Builder|Sellable hasVariants($filter)
 * @method static Builder|Sellable newModelQuery()
 * @method static Builder|Sellable newQuery()
 * @method static Builder|Sellable query()
 * @method static Builder|Sellable whereCreatedAt($value)
 * @method static Builder|Sellable whereDescription($value)
 * @method static Builder|Sellable whereEditable($value)
 * @method static Builder|Sellable whereId($value)
 * @method static Builder|Sellable whereInventory($value)
 * @method static Builder|Sellable whereIsActive($value)
 * @method static Builder|Sellable whereName($value)
 * @method static Builder|Sellable wherePrice($value)
 * @method static Builder|Sellable whereTrackInventory($value)
 * @method static Builder|Sellable whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sellable extends Model implements HasTemplateInterface
{
    use HasTemplate;

    protected $fillable = [
        'name',
        'price',
        'inventory',
        'editable',
        'is_active',
        'track_inventory',
        'description',
    ];

    protected $appends = [
        'has_variants',
    ];
    protected $casts = [
        'editable'        => 'boolean',
        'is_active'       => 'boolean',
        'has_variants'    => 'boolean',
        'track_inventory' => 'boolean',
    ];

    // region Relation

    public function variants(): BelongsToMany {
        return $this->belongsToMany(Variant::class)
                    ->using(SellableVariant::class)
                    ->withPivot(['price', 'inventory', 'description', 'is_active']);
    }

    // endregion


    // region Relation

    public function getHasVariantsAttribute(): bool {
        return $this->variants->count() > 0;
    }

    // endregion

    // region Scope

    public function scopeHasVariants(Builder $query, bool $filter): Builder {
        if($filter) {
            return $query->whereIn('id',
                fn($sq) => $sq->select('sellable_id')
                              ->from('sellable_variant'));
        } else {
            return $query->whereNotIn('id',
                fn($sq) => $sq->select('sellable_id')
                              ->from('sellable_variant'));
        }

    }

    // endregion


}
