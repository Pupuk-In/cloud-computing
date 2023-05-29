<?php

namespace App\Providers;

use Laravel\Sanctum\Console\ClientCommand;
use Laravel\Sanctum\Console\InstallCommand;
use Laravel\Sanctum\Console\KeysCommand;
use Laravel\Sanctum\Sanctum;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\PriceRangeFilter;
use Illuminate\Support\ServiceProvider;
use Spatie\QueryBuilder\Filters\Filter;

use Illuminate\Support\Facades\Schema;

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
        
        ]);
    }
}
