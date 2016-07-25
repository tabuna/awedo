<?php namespace App\Http\Composers;

use App\Models\Country;
use Cache;
use Illuminate\Contracts\View\View;

class CountryComposers
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {

        /*
        $cityList = Cache::remember('cityList', 60, function () {
            return City::all();
        });
        */

        $countryList = Cache::remember('countryList', 60, function () {
            return Country::all();
        });


        //$view->with('cityList', $cityList);
        $view->with('countryList', $countryList);
    }

}
