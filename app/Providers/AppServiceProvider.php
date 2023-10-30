<?php

namespace App\Providers;

use App\Services\Amo\AmoCRMService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('amo', AmoCRMService::class);
    }

    public function boot(): void
    {
        //
    }
}
