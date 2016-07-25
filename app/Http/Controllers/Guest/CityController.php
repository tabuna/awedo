<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\HttpTraits\IndexTraits;
use App\Models\City;
use Auth;
use Cache;
use Flash;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Guest\IndexController;

class CityController extends Controller
{


    use IndexTraits;

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((integer)$id > 0) {
            $city = Cache::remember('CityChanged-' . $id, 60, function () use ($id) {
                return City::findOrFail($id);
            });
            Session::put('GeoCity', $city);
            return redirect()->back();
        } else {
            $city = Cache::remember('CityChanged-' . $id, 60, function () use ($id) {
                return City::where('ascii_name', $id)->firstOrFail();
            });
            Session::put('GeoCity', $city);
            return $this->index();
        }

    }


}
