<?php

    namespace App\Http\Middleware;

    use App\Models\City;
    use Closure;
    use GeoIP;
    use Session;
    use View;

    class GeoIPMiddleware
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure                 $next
         *
         * @return mixed
         */
        public function handle($request, Closure $next)
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


            View::composer('*', function () {
                View::share('GeoCity', Session::get('GeoCity'));
            });

            return $next($request);
        }
    }
