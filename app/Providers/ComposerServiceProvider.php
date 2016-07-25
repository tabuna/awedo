<?php namespace App\Providers;

use App\Http\Composers\CountryComposers;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', CountryComposers::class);
        //View::composer('*', GeoComposers::class);
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

}