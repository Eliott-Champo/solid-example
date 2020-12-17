<?php

namespace App\Providers;

use App\Networks\TwitterNetwork;
use App\Networks\FacebookNetwork;
use App\Contracts\ProviderInterface;
use App\Providers\SocialiteProvider;
use Illuminate\Support\ServiceProvider;
use App\Contracts\SocialNetworkInterface;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\FacebookController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProviderInterface::class, SocialiteProvider::class);

        $this->app->when(FacebookController::class)
            ->needs(SocialNetworkInterface::class)
            ->give(function () {
                return new FacebookNetwork(new SocialiteProvider);
            });

        $this->app->when(TwitterController::class)
            ->needs(SocialNetworkInterface::class)
            ->give(function () {
                return new TwitterNetwork(new SocialiteProvider);
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
