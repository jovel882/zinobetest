<?php

namespace App;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Blade\Blade;
use App\Controllers\UserController;
use App\Controllers\CountryController;
use App\Interfaces\ModelInterface;
Use App\Models\User;
Use App\Models\Country;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Blade::class, function ($app) {
            return new Blade('App/Views/', 'cache');
        });
        $this->app->when(UserController::class)
            ->needs(ModelInterface::class)
            ->give(function () {
                return new User();
            });
        $this->app->when(CountryController::class)
            ->needs(ModelInterface::class)
            ->give(function () {
                return new Country();
            });
    }
}
?>