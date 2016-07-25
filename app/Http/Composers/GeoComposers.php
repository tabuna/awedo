<?php namespace App\Http\Composers;

use App\Models\City;
use Cache;
use GeoIP;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Session;

class GeoComposers
{

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $user;

    /**
     * Create a new profile composer.
     *
     * @param Guard $user
     */
    public function __construct(Guard $user)
    {
        // Зависимости разрешаются автоматически службой контейнера...
        $this->user = $user->user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        if (!Session::has('GeoCity')) {
            $ascii_name = GeoIP::getLocation()['city'];
            $city = City::where('ascii_name', $ascii_name)->first();

            if (is_null($city)) {
                $city = 1;
            } else {
                $city = $city->id;
            }


            $GeoCity = City::find($city);
            Session::put('GeoCity', $GeoCity);
        }

        $view->with('GeoCity', Session::get('GeoCity'));
    }

}