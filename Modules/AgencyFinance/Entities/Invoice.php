<?php

namespace Modules\AgencyFinance\Entities;

use Anacreation\Workflow\Contracts\HasWorkflowInterface;
use Anacreation\Workflow\Traits\HasWorkflow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyCore\Entities\Client;

/**
 * Modules\AgencyFinance\Entities\Invoice
 *
 * @property int
 *                $id
 * @property string
 *                $invoice_number
 * @property string
 *                $due_date
 * @property float
 *                $discount
 * @property string|null
 *                $note
 * @property string
 *                $status
 * @property int
 *                $contract_id
 * @property int
 *                $client_id
 * @property int|null
 *                $invoice_id
 * @property \Illuminate\Support\Carbon|null
 *                $created_at
 * @property \Illuminate\Support\Carbon|null
 *                $updated_at
 * @property-read Client
 *                     $client
 * @property-read Contract
 *                     $contract
 * @property-read \Anacreation\Workflow\Entities\CurrentState|null
 *                     $currentState
 * @property-read \Anacreation\Workflow\Entities\State
 *                     $current_state
 * @property-read float
 *                     $paid
 * @property-read float
 *                     $total
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyFinance\Entities\InvoiceItem[]
 *                $items
 * @property-read int|null
 *                     $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyFinance\Entities\Payment[]
 *                    $payments
 * @property-read int|null
 *                     $payments_count
 * @property-read Invoice|null
 *                     $previousInvoice
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read int|null $contract_count
 * @property-read float $net
 */
class Invoice extends Model implements HasWorkflowInterface
{
    use HasWorkflow;

    protected $fillable = [
        'discount',
        'invoice_number',
        'client_id',
        'contract_id',
        'invoice_id',
        'due_date',
        'note',
    ];

    protected $appends = [
        'total',
        'paid',
        'net',
    ];

    protected $with = ['items'];

    public const STATUS = [
        'void'        => 'void',
        'paid'        => 'paid',
        'active'      => 'active',
        'invalidated' => 'invalidated',
    ];

    // region Relation

    public function items(): HasMany {
        return $this->hasMany(InvoiceItem::class);
    }

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class);
    }

    public function contract(): BelongsTo {
        return $this->belongsTo(Contract::class);
    }

    public function previousInvoice(): BelongsTo {
        return $this->belongsTo(Invoice::class,
                                'invoice_id');
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class);
    }


    // endregion


    // region Accessors
    public function getTotalAttribute(): float {
        $this->load('items');

        return $this->total() - $this->discount;
    }

    public function getPaidAttribute(Invoice $previousInvoice = null, float $total = 0): float {
        $total = $total + $this->payments()->sum('amount');

        if($this->previousInvoice) {
            $total = $this->getPaidAttribute($this->previousInvoice,
                                             $total);
        }

        return $total;
    }

    public function getNetAttribute(): float {
        return $this->total - $this->paid;
    }

    // endregion


    // region Helper

    public function total(): float {
        $total = $this->items->sum->total();

        return $total;
    }


    // endregion
}
