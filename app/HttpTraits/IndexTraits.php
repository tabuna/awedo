<?php

namespace App\HttpTraits;

use App\Models\Advertising;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Cache;
use Session;


trait IndexTraits
{

    public function index()
    {

        /*
         * Категории
         */
        $categoryList = Cache::remember('categoryListColums', 60, function () {
            $category = Category::MainCategory()
                ->with('getSubCategory')
                ->orderBy('name', 'ASC')
                ->get();

            $columCount = ceil(count($category) / 3);

            return [
                $category->slice(0, $columCount),
                $category->slice($columCount, $columCount),
                $category->slice($columCount * 2),
            ];
        });


        $popularCategory = Cache::remember('popularCategory-' . Session::get('GeoCity')->id, 60, function () {
            return Advertising::popularCategory()->get();
        });


        $CategoryCount = Cache::remember('CategoryCount', 60, function () {
            return Category::count();
        });

        /*
         * Города
         */
        $allCity = Cache::remember('allCity', 60, function () {
            return City::lists('id', 'name');
        });

        $CityCount = Cache::remember('CityCount', 60, function () use ($allCity) {
            return City::count();
        });

        /*
         * Пользователи
         */

        $UserCount = Cache::remember('UserCount', 60, function () {
            return User::count();
        });


        /*
         * Обьявления
         */
        $advertisingCount = Cache::remember('advertisingCount', 60, function () {
            return Advertising::count();
        });


        return view('guest.index', [
            'categoryList' => $categoryList,
            'popularCategory' => $popularCategory,
            'allCity' => $allCity,
            'CityCount' => $CityCount,
            'UserCount' => $UserCount,
            'CategoryCount' => $CategoryCount,
            'advertisingCount' => $advertisingCount,
        ]);
    }


}