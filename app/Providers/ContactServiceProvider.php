<?php

namespace App\Providers;

use App\Contracts\Services\ContactServiceInterface;
use App\Services\ContactService;
use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ContactServiceInterface::class, ContactService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
