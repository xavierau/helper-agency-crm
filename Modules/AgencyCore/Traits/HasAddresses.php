<?php

namespace Modules\AgencyCore\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\AgencyCore\Entities\Address;

trait HasAddresses
{
    public function addresses(): MorphToMany
    {
        return $this->morphToMany(Address::class,
            'owner',
            'address_owners');
    }
}
