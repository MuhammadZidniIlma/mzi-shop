<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class SchedulingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->app->booted(function () {
            $schedule = app(Schedule::class);

            // Menjadwalkan command untuk dijalankan setiap hari
            $schedule->command('discounts:update-statuses')->daily();
        });
    }
}
