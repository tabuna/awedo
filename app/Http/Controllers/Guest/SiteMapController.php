<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\City;
use Cache;

class SiteMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AllCity = Cache::remember('AllCity', 60, function () {
            return City::all();
        });

        return view('guest.sitemap', [
            'AllCity' => $AllCity,
        ]);
    }


}
