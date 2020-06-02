<?php

namespace App\Providers;

use App\Interfaces\TodotaskRepositoryInterface;
use App\Repositories\TodotaskRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
        TodotaskRepositoryInterface::class,
        TodotaskRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
