<?php

namespace App\Providers;

use Doctrine\DBAL\Connection;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(Connection::class, function (): Connection {
            $connectionParams = [
                'dbname' => env('DB_DATABASE'),
                'user' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'host' => env('DB_HOST'),
                'driver' => 'pdo_' . env('DB_CONNECTION'),
            ];

            return \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
