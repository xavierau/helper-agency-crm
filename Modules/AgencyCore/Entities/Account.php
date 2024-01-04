<?php

namespace Modules\AgencyCore\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyCore\Traits\HasAddresses;

/**
 * Modules\AgencyCore\Entities\Account
 *
 * @property int
 *           $id
 * @property \Illuminate\Support\Carbon|null
 *           $created_at
 * @property \Illuminate\Support\Carbon|null
 *           $updated_at
 * @property-read \Modules\AgencyCore\Entities\Client|null
 *                $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Client[]
 *                $clients
 * @property-read int|null
 *                $clients_count
 * @property-read Collection
 *                $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Job[]
 *                $jobs
 * @property-read int|null
 *                $jobs_count
 * @method static Builder|Account newModelQuery()
 * @method static Builder|Account newQuery()
 * @method static Builder|Account query()
 * @method static Builder|Account whereCreatedAt($value)
 * @method static Builder|Account whereId($value)
 * @method static Builder|Account whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|Contract[] $contracts
 * @property-read int|null $contracts_count
 */
class Account extends Model
{
    use HasAddresses;

    protected $fillable = [];

    protected $appends = ['addresses'];

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function client(): HasOne
    {
        return $this->HasOne(Client::class)
            ->where('is_primary',
                true);
    }

    public function jobs(): HasManyThrough
    {
        return $this->hasManyThrough(Job::class,
            Client::class);
    }

    public function contracts(): HasManyThrough
    {
        return $this->hasManyThrough(Contract::class,
            Client::class);
    }

}
