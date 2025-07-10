<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\State;
use App\Models\Package;

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

        $stateIds = Package::pluck('state_id')->toArray();
        $cityIdsRaw = Package::pluck('city_id')->toArray();

        $cityIds = collect($cityIdsRaw)
            ->flatMap(function ($item) {
                return explode(',', $item);
            })
            ->unique()
            ->filter()
            ->map(function ($id) {
                return (int) trim($id);
            })
            ->toArray();

            $states = State::whereIn('id', $stateIds)
            ->with(['cities' => function($query) use ($cityIds) {
                $query->whereIn('id', $cityIds);
            }])
            ->get();


            $view->with('states', $states);
        });
    }
}
