<?php

namespace Modules\AgencyCore\Entities;

use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\AgencyCore\Contracts\HasCommentInterface;
use Modules\AgencyCore\Traits\HasComment;

/**
 * Modules\AgencyCore\Entities\Job
 *
 * @property int
 *              $id
 * @property string
 *              $service_type
 * @property string
 *              $type
 * @property string|null
 *              $nationality
 * @property string
 *              $status
 * @property array|null
 *              $services
 * @property string|null
 *              $note
 * @property int
 *              $client_id
 * @property int
 *              $account_id
 * @property \Illuminate\Support\Carbon|null
 *              $created_at
 * @property \Illuminate\Support\Carbon|null
 *              $updated_at
 * @property-read \Modules\AgencyCore\Entities\Account
 *                   $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Applicant[]
 *                   $applicants
 * @property-read int|null
 *                   $applicants_count
 * @property-read \Modules\AgencyCore\Entities\Client
 *                   $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\DomesticDuty[]
 *                $duties
 * @property-read int|null
 *                   $duties_count
 * @property-read string
 *                   $client_name
 * @method static Builder|Job clientName($keyword = null)
 * @method static Builder|Job newModelQuery()
 * @method static Builder|Job newQuery()
 * @method static Builder|Job query()
 * @method static Builder|Job requestWith($keyword = null)
 * @method static Builder|Job search($keyword = null)
 * @method static Builder|Job status($keyword = null)
 * @method static Builder|Job whereAccountId($value)
 * @method static Builder|Job whereClientId($value)
 * @method static Builder|Job whereCreatedAt($value)
 * @method static Builder|Job whereId($value)
 * @method static Builder|Job whereNationality($value)
 * @method static Builder|Job whereNote($value)
 * @method static Builder|Job whereServiceType($value)
 * @method static Builder|Job whereServices($value)
 * @method static Builder|Job whereStatus($value)
 * @method static Builder|Job whereType($value)
 * @method static Builder|Job whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Modules\AgencyCore\Entities\Requirement|null $requirement
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Comment[] $comments
 * @property-read int|null $comments_count
 */
class Job extends Model implements HasCommentInterface
{
    use CommonScopes, HasComment;

    protected $fillable = [
        'service_type',
        'nationality',
        'status',
        'note',
        'type',
        'services',
    ];

    protected $appends = [
        'client_name',
    ];

    // region Relation

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function duties(): BelongsToMany
    {
        return $this->BelongsToMany(DomesticDuty::class);
    }

    public function applicants(): BelongsToMany
    {
        return $this->BelongsToMany(Applicant::class)
            ->withPivot([
                'status',
                'channel',
            ])
            ->withTimestamps();
    }

    public function requirement(): HasOne
    {
        return $this->hasOne(Requirement::class);
    }

    //endregion

    // region Accessor

    public function getClientNameAttribute(): string
    {
        return sprintf('%s %s %s',
            $this->client->prefix,
            $this->client->first_name,
            $this->client->last_name);
    }

    public function getServicesAttribute($value): ?array
    {
        return json_decode($value,
            true);
    }

    //endregion

    // region Mutator

    public function setServicesAttribute($value): void
    {
        $this->attributes['services'] = json_encode($value);
    }

    //endregion

    // region Scope

    public function scopeClientName(Builder $query, string $keyword = null): Builder
    {
        if ($keyword === null) {
            return $query;
        }

        return $query->whereHas('client',
            fn($sq) => $sq->where('first_name',
                'like',
                "%{$keyword}%")->orWhere('first_name',
                'like',
                "%{$keyword}%"));
    }

    public function scopeSearch(Builder $query, string $keyword = null): Builder
    {
        return $query->clientName($keyword);
    }

    public function scopeStatus(Builder $query, string $keyword = null): Builder
    {
        return $query->where('status',
            $keyword ?? 'active');
    }


    //endregion

    //region Helpers

    public function getExpectedSalary(): string
    {
        return sprintf("%s %s",
            'HK$',
            number_format(4300,
                1));
    }

    //endregion
}
