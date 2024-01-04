<?php

namespace Modules\AgencyFinance\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyFinance\Enums\CreditNoteStatus;

/**
 * Modules\AgencyFinance\Entities\CreditNote
 *
 * @property int $id
 * @property string $credit_note_number
 * @property int $from_contract_id
 * @property int|null $to_contract_id
 * @property float $amount
 * @property \Illuminate\Support\Carbon $expired_date
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Contract|null $fromContract
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyFinance\Entities\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read Contract|null $toContract
 * @method static Builder|CreditNote newModelQuery()
 * @method static Builder|CreditNote newQuery()
 * @method static Builder|CreditNote query()
 * @method static Builder|CreditNote search(string $keyword)
 * @method static Builder|CreditNote whereAmount($value)
 * @method static Builder|CreditNote whereCreatedAt($value)
 * @method static Builder|CreditNote whereCreditNoteNumber($value)
 * @method static Builder|CreditNote whereExpiredDate($value)
 * @method static Builder|CreditNote whereFromContractId($value)
 * @method static Builder|CreditNote whereId($value)
 * @method static Builder|CreditNote whereStatus($value)
 * @method static Builder|CreditNote whereToContractId($value)
 * @method static Builder|CreditNote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CreditNote extends Model
{
    protected $fillable = [
        'status',
        'amount',
        'expired_date',
        'to_contract_id',
        'from_contract_id',
        'credit_note_number',
    ];

    protected $casts = [
        'expired_date' => 'date',
    ];

    // region Relation

    public function fromContract(): BelongsTo {
        return $this->belongsTo(Contract::class,
                                'from_contract_id');
    }

    public function toContract(): BelongsTo {
        return $this->belongsTo(Contract::class,
                                'to_contract_id');
    }

    public function payments(): BelongsToMany {
        return $this->belongsToMany(Payment::class)
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    // endregion

    // region Accessors

    public function getStatusAttribute(): string {
        switch($this->attributes['status']) {
            case 'pending':
                return 'pending';
            default:
                if($this->to_contract_id) {
                    return 'used';
                } elseif(now()->gt($this->expired_date)) {
                    return 'expired';
                } else {
                    return 'active';
                }
        }
    }

    // endregion

    // region Scope

    public function scopeSearch(Builder $query, string $keyword): Builder {
        return $query->where('status',
                             CreditNoteStatus::ACTIVE())
                     ->where(function($q) use ($keyword) {
                         return $q->whereHas('fromContract.client',
                             function($sq) use ($keyword) {
                                 return $sq->where('first_name',
                                                   'like',
                                                   "%{$keyword}%")
                                           ->orWhere('last_name',
                                                     'like',
                                                     "%{$keyword}%")
                                           ->orWhere('mobile',
                                                     'like',
                                                     "%{$keyword}%");

                             })
                                  ->orWhere('credit_note_number',
                                            'like',
                                            "%{$keyword}%");
                     });

    }


    // endregion

    // region Helpers

    public function applyCreditNotreForContract(Contract $contract): void {
        $this->to_contract_id = $contract->id;
        $this->status = CreditNoteStatus::USED();
        $this->save();
    }

    public function applyCreditNoteForPayment(Payment $payment): void {
        $this->applyCreditNotreForContract($payment->invoice->contract);

        $this->payments()
             ->attach($payment->id,
                      ['amount' => $this->amount]);
    }


    // endregion
}
