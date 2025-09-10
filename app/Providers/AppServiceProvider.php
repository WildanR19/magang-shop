<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
        // Paginator::defaultView('layouts.partials.pagination');
        Paginator::useBootstrapFive();
        Blade::directive('currency', function ($exp) {
            return "<?php echo 'Rp ' . number_format($exp, 0, ',', '.'); ?>";
        });
    }
}
