<?php

namespace App\Providers;

use Laravel\Sanctum\Console\ClientCommand;
use Laravel\Sanctum\Console\InstallCommand;
use Laravel\Sanctum\Console\KeysCommand;
use Laravel\Sanctum\Sanctum;

use Illuminate\Support\Facades\Schema;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            // InstallCommand::class,
            // ClientCommand::class,
            // KeysCommand::class,
        ]);
    }
}
