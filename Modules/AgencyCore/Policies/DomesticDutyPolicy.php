<?php

namespace Modules\AgencyCore\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class DomesticDutyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }
}
