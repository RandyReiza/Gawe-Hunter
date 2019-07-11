<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // bikin formatter untuk tanggal
        Blade::directive('datetime', function ($expression) {
            return "<?php echo date('d F Y', strtotime($expression)); ?>";
        });
    }
}
