<?php

namespace App\Providers;

use App\Migrant;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('dashboard/*', function($view){
            $data = [
                'admin' => auth()->user(),
                'nb_admins' => count(User::all()),
                'nb_migrants' => count(Migrant::all()),
            ];

            View::share($data);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
