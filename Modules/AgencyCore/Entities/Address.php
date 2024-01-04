<?php

namespace Modules\AgencyCore\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modules\AgencyCore\Entities\Address
 *
 * @property int
 *           $id
 * @property string|null
 *           $address_1
 * @property string|null
 *           $address_2
 * @property string|null
 *           $address_3
 * @property string|null
 *           $state
 * @property string|null
 *           $country
 * @property string|null
 *           $postal_code
 * @property \Illuminate\Support\Carbon|null
 *           $created_at
 * @property \Illuminate\Support\Carbon|null
 *           $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Client[]
 *                $clients
 * @property-read int|null
 *                $clients_count
 * @property-read string
 *                $label
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $full_address
 * @property string $owner_type
 * @property int $owner_id
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereOwnerType($value)
 */
class Address extends Model
{
    protected $fillable = [
        'address_1',
        'address_2',
        'address_3',
        'state',
        'country',
        'postal_code',
    ];

    protected $appends = [
        'label',
    ];

    public function clients(): BelongsToMany {
        return $this->belongsToMany(Client::class);
    }

    public function getLabelAttribute(): string {
        return join(', ',
                    array_filter([
                                     $this->address_1,
                                     $this->address_2,
                                     $this->address_3,
                                     $this->country,
                                 ],
                        fn($i) => !is_null($i)));
    }

    public function getFullAddressAttribute(): string {
        $array = collect([
                             $this->address_1,
                             $this->address_2,
                             $this->address_3,
                             $this->country,
                         ])
            ->reject(null)
            ->values()
            ->toArray();

        return implode(", ",
                       $array);
    }
}
