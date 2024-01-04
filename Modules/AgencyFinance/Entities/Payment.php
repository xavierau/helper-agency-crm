<?php

namespace Modules\AgencyFinance\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Modules\AgencyFinance\Entities\Payment
 *
 * @property int                                          $id
 * @property float                                        $amount
 * @property string|null                                  $note
 * @property string                                       $type
 * @property int                                          $invoice_id
 * @property \Illuminate\Support\Carbon|null              $created_at
 * @property \Illuminate\Support\Carbon|null              $updated_at
 * @property-read \Modules\AgencyFinance\Entities\Invoice $invoice
 * @method static Builder|Payment client()
 * @method static Builder|Payment newModelQuery()
 * @method static Builder|Payment newQuery()
 * @method static Builder|Payment query()
 * @method static Builder|Payment whereAmount($value)
 * @method static Builder|Payment whereCreatedAt($value)
 * @method static Builder|Payment whereId($value)
 * @method static Builder|Payment whereInvoiceId($value)
 * @method static Builder|Payment whereNote($value)
 * @method static Builder|Payment whereType($value)
 * @method static Builder|Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyFinance\Entities\CreditNote[] $creditNotes
 * @property-read int|null $credit_notes_count
 * @property-read string|null $attachment
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 */
class Payment extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'invoice_id',
        'type',
        'amount',
        'note',
    ];

    protected $appends = [
        'attachment',
    ];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('attachments');
    }

    // region Relation

    public function invoice(): BelongsTo {
        return $this->belongsTo(Invoice::class);
    }

    public function creditNotes(): BelongsToMany {
        return $this->belongsToMany(CreditNote::class)
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    // endregion

    // region Accessor

    public function getAttachmentAttribute(): ?string {
        return optional($this->getMedia('attachments')->first())->getUrl();
    }


    // endregion

    // region Scope

    public function scopeClient(): Builder {
        return $this->invoice->client();
    }

    // endregion
}
