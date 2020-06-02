<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SqliteProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Check for SQLite DB existance and create it if not present
     *
     * @return void
     */
    public function boot()
    {
        $databaseFile = config('database.connections.sqlite.database');
        if ($databaseFile != ':memory:') {
            if (!file_exists($databaseFile)) {
                info('Make Sqlite File "' . $databaseFile . '"');
                file_put_contents($databaseFile, '');
            }
        }
    }
}
