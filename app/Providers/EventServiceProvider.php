<?php

namespace App\Providers;

use Anacreation\Workflow\Events\TransitionApplied;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\AgencyContract\EventHandlers\ContractCancelled;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class        => [
            SendEmailVerificationNotification::class,
        ],
        TransitionApplied::class => [
            ContractCancelled::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() {
        parent::boot();

        //
    }
}
