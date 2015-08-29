<?php

namespace App\Providers;

use App\Models\Card;
use App\Models\CardSets;
use App\Models\CardType;
use Illuminate\Support\ServiceProvider;

class CardServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Card', function () {
            return new Card($this->app['Game']);
        });

        $this->app->singleton('CardSets', function () {
            return new CardSets();
        });
    }
}