<?php

namespace Modules\AgencyFinance\Entities;

use App\Traits\LogActivities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\AgencyCore\Entities\Sellable;
use Modules\AgencyCore\Entities\SellableVariant;
use Modules\AgencyCore\Entities\Variant;
use Modules\AgencyTemplate\Contracts\HasTemplateInterface;
use Modules\AgencyTemplate\Traits\HasTemplate;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Modules\AgencyFinance\Entities\InvoiceItem
 *
 * @property int $id
 * @property float $qty
 * @property float $price
 * @property float $discount
 * @property string|null $note
 * @property int $invoice_id
 * @property int $sellable_id
 * @property int|null $variant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyTemplate\Entities\Template[] $template
 * @property-read \Modules\AgencyFinance\Entities\Invoice $invoice
 * @property-read Sellable $sellable
 * @property-read int|null $template_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyTemplate\Entities\Template[] $templates
 * @property-read int|null $templates_count
 * @property-read Variant|null $variant
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereSellableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceItem whereVariantId($value)
 * @mixin \Eloquent
 */
class InvoiceItem extends Model implements HasTemplateInterface
{
    use HasTemplate;
    use LogActivities;


    protected $fillable = [
        'sellable_id',
        'variant_id',
        'qty',
        'price',
        'note',
        'discount',
    ];

    protected $with = ['sellable', 'variant'];

    // region Relation

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function sellable(): BelongsTo
    {
        return $this->belongsTo(Sellable::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }

    // endregion

    // region Helper

    public function total(): float
    {
        return ($this->qty * $this->price) - $this->discount;
    }

    public function getHasPrintTemplateItem(): HasTemplateInterface
    {
        return $this->variant_id ?
            SellableVariant::where('sellable_id',
                $this->id)
                ->where('variant_id',
                    $this->variant_id)
                ->firstOrFail() :
            $this->sellable;
    }

    // endregion
}
