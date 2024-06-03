<?php

namespace App\Providers;

use App\Interfaces\UrlShortenerInterface;
use App\Repositories\UrlShortenerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UrlShortenerInterface::class, UrlShortenerRepository::class);
    }
}
