<?php

namespace Modules\AgencyCore\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalityPolicy
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
