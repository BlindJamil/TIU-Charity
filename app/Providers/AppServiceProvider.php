<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

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
        if ($this->app->runningInConsole()) {
            return;
        }

        try {
            if (Schema::hasTable('settings')) {
                $settings = Cache::rememberForever('settings', function () {
                    return Setting::pluck('value', 'key')->all();
                });
                View::share('settings', $settings);
            }
        } catch (\Exception $e) {
            Log::error('Could not load settings in AppServiceProvider: ' . $e->getMessage());
        }
    }
}