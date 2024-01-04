<?php

namespace Modules\AgencyCore\Entities;

use Anacreation\Organization\Traits\InOrganization;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyCore\DataTransferObject\GlobalSearchResult;
use Modules\AgencyCore\Traits\HasAddresses;
use Modules\AgencyFinance\Entities\Invoice;

/**
 * Modules\AgencyCore\Entities\Client
 *
 * @property int
 *                    $id
 * @property string
 *                    $prefix
 * @property string|null
 *                    $first_name
 * @property string|null
 *                    $last_name
 * @property string|null
 *                    $chinese_first_name
 * @property string|null
 *                    $chinese_last_name
 * @property string|null
 *                    $occupation
 * @property \Illuminate\Support\Carbon|null
 *                    $date_of_birth
 * @property string|null
 *                    $place_of_birth
 * @property int
 *                    $is_male
 * @property string|null
 *                    $email
 * @property string|null
 *                    $tel
 * @property string|null
 *                    $mobile
 * @property string|null
 *                    $company_name
 * @property string|null
 *                    $marital_status
 * @property string|null
 *                    $hk_id
 * @property string|null
 *                    $nationality
 * @property string|null
 *                    $relation
 * @property string
 *                    $client_number
 * @property int
 *                    $is_primary
 * @property int
 *                    $account_id
 * @property \Illuminate\Support\Carbon|null
 *                    $created_at
 * @property \Illuminate\Support\Carbon|null
 *                    $updated_at
 * @property-read \Modules\AgencyCore\Entities\Account
 *                         $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Address[]
 *                         $addresses
 * @property-read int|null
 *                         $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Contract[]
 *                         $contracts
 * @property-read int|null
 *                         $contracts_count
 * @property-read string
 *                         $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|Invoice[]
 *                         $invoices
 * @property-read int|null
 *                         $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Job[]
 *                         $jobs
 * @property-read int|null
 *                         $jobs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Job[]
 *                         $myJobs
 * @property-read int|null
 *                         $my_jobs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Anacreation\Organization\Entities\Organization[]
 *                $organizations
 * @property-read int|null
 *                         $organizations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client
 *         inOrganization(\Anacreation\Organization\Entities\Organization $organization,
 *         $include_sub_org = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereChineseFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereChineseLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereClientNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereHkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIsMale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $require_constant_care
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRequireConstantCare($value)
 * @property-read string $chinese_full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|Client[] $relatives
 * @property-read int|null $relatives_count
 * @property int|null $gid
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereGid($value)
 */
class Client extends Model
{
    use InOrganization, HasAddresses;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = [
        'full_name',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_male' => 'boolean',
    ];

    //region Relation

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class)
            ->latest();
    }

    public function myJobs(): HasMany
    {
        return $this->hasMany(Job::class)
            ->latest();
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class)
            ->latest();
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class)->latest();
    }

    public function relatives(): BelongsToMany
    {
        return $this->belongsToMany(Client::class,
            'client_relation',
            'principle_id',
            'other_id')
            ->withPivot('relation');
    }

    //endregion

    //Region: Scope

    public function scopeSearchGlobally(Builder $query, ?string $value)
    {
        return $query
            ->where('first_name', 'like', "%{$value}%")
            ->orWhere('last_name', 'like', "%{$value}%")
            ->orWhere('mobile', 'like', "%{$value}%")
            ->orWhere('hk_id', 'like', "%{$value}%");
    }

    //endregion

    //region Accessor

    public function getFullNameAttribute(): string
    {
        return sprintf("%s %s",
            $this->first_name,
            $this->last_name);
    }

    public function getChineseFullNameAttribute(): string
    {
        return sprintf("%s %s",
            $this->chinese_last_name,
            $this->chinese_first_name);
    }

    public function getPrimaryAddress(): ?Address
    {
        return $this->addresses->first();
    }

    //endregion

    //region Helper


    public static function globalSearch(?string $value): Collection
    {

        return (new static())
            ->searchGlobally($value)
            ->get()
            ->map(fn(Client $client) => new GlobalSearchResult($client));

    }

    public function isChildren(): bool
    {
        return $this->date_of_birth->LessThan(Carbon::now())
            && $this->date_of_birth->greaterThan(Carbon::now()
                ->addYears(-18));
    }

    public function isElderly(): bool
    {
        return $this->date_of_birth->lessThan(Carbon::now()
            ->addYears(-65));
    }

    public function isAdult(): bool
    {
        return !$this->isChildren() && !$this->isElderly();
    }

    //endregion
}
