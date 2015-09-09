<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\DeathEvent' => [
            'App\Listeners\Deathrattle'
        ],
        'App\Events\AfterSummonPhaseEvent' => [
            'App\Listeners\AfterSummonPhase'
        ],
        'App\Events\BattlecryPhaseEvent' => [
            'App\Listeners\BattlecryPhase'
        ],
        'App\Events\SpellTextPhaseEvent' => [
            'App\Listeners\SpellTextPhase'
        ]
    ];
}
