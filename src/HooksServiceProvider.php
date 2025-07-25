<?php

namespace Juzaweb\Hooks;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Juzaweb\Hooks\Contracts\Hook;

class HooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /*
         * Adds a directive in Blade for actions
         */
        Blade::directive(
            'do_action',
            function ($expression) {
                return "<?php app(\Juzaweb\Hooks\Contracts\Hook::class)->action({$expression}); ?>";
            }
        );

        /*
         * Adds a directive in Blade for filters
         */
        Blade::directive(
            'apply_filters',
            function ($expression) {
                return "<?php echo app(\Juzaweb\Hooks\Contracts\Hook::class)->filter({$expression}); ?>";
            }
        );
    }

    public function register()
    {
        // Registers the eventy singleton.
        $this->app->singleton(
            Hook::class,
            function () {
                return new HookRepository();
            }
        );
    }
}
