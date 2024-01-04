<?php

namespace Modules\AgencyContractDoc\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ContractDocValuePolicy
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
