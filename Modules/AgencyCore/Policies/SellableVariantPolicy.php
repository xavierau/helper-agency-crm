<?php

namespace Modules\AgencyCore\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class SellableVariantPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
