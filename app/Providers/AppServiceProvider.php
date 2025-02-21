<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\State;

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
        View::composer('front.common.header', function ($view) {
            $states = State::with('cities')->get();
            $view->with('states', $states);
        });
    }
}
