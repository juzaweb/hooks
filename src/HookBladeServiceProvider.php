<?php

namespace Theanh\LaravelHooks;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HookBladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Adds a directive in Blade for actions
         */
        Blade::directive('do_action', function ($expression) {
            return "<?php app('eventy')->action({$expression}); ?>";
        });

        /*
         * Adds a directive in Blade for filters
         */
        Blade::directive('apply_filters', function ($expression) {
            return "<?php echo app('eventy')->filter({$expression}); ?>";
        });
        
    }
}
