<?php

namespace Tadcms\Hooks;

use Illuminate\Support\ServiceProvider;
use Tadcms\Hooks\Hooks\Events;

class HooksServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Registers the eventy singleton.
        $this->app->singleton('eventy', function ($app) {
            return new Events();
        });
        
        // Register service providers
        $this->app->register(HookBladeServiceProvider::class);
    }
}