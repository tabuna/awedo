<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Advertising;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Cache;
use Session;
use App\HttpTraits\IndexTraits;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    use IndexTraits;
    

    public function getStowns($id)
    {

        $cityList = Cache::remember('getStowns-' . $id, 60, function () use ($id) {

            $city = City::select('id', 'name')
                ->where('country_id', $id)
                ->orderBy('name', 'ASC')
                ->get();

            $columCount = ceil(count($city) / 3);
            $city = [
                $city->slice(0, $columCount),
                $city->slice($columCount, $columCount),
                $city->slice($columCount * 2),
            ];

            return $city;
        });

        return response()->json($cityList);
    }


    public function getCity($id)
    {
        $cityList = Cache::remember('getCity-' . $id, 60, function () use ($id) {
            $city = City::select('id', 'name')
                ->where('country_id', $id)
                ->orderBy('name', 'ASC')
                ->get();

            return $city;
        });

        return response()->json($cityList);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($city)
    {
        $city = Cache::remember('CityChanged-' . $city, 60, function () use ($city) {
            return City::findOrFail($city);
        });
        Session::put('GeoCity', $city);
        $this->index();
    }

}
