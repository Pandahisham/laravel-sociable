<?php

namespace Tshafer\Sociable;

use Tshafer\ServiceProvider\ServiceProvider as BaseProvider;
use Tshafer\Sociable\Events\UserHasSocialized;
use Tshafer\Sociable\Listeners\UserHasSocializedListener;
use Laravel\Socialite\SocialiteServiceProvider;

class ServiceProvider extends BaseProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->setup(__DIR__)
          ->publishMigrations();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(SocialiteServiceProvider::class);

        $this->app['events']->listen(
          UserHasSocialized::class, UserHasSocializedListener::class
        );
    }
}
