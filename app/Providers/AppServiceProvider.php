<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('hideOnSpecificPage', function ($expression) {
            return "<?php if (! request()->is($expression)): ?>"; // Note the '!' for negation
        });
    
        Blade::directive('endHideOnSpecificPage', function () {
            return "<?php endif; ?>";
        });
    }
}
