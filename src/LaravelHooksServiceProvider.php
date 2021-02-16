<?php

namespace Theanh\LaravelHooks;

use Illuminate\Support\ServiceProvider;
use Theanh\LaravelHooks\Hooks\Events;

class LaravelHooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
    
    }
    
    public function register()
    {
        // Registers the eventy singleton.
        $this->app->singleton('eventy', function ($app) {
            return new Events();
        });
        
        // Register service providers
        //$this->registerServiceProvider();
        
        // Register helper file
        require_once(__DIR__ . '/Helpers/helpers.php');
    }
    
    protected function registerServiceProvider() {
        $this->app->register(HookBladeServiceProvider::class);
    }
}