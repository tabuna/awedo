<?php

    namespace App\Http\Controllers\Guest;

    use App\Http\Controllers\Controller;
    use App\Http\Requests;
    use App\Models\Advertising;
    use App\Models\Category;
    use App\Models\City;
    use Cache;
    use Illuminate\Http\Request;
    use Session;

    class CategoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index(Request $request)
        {
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  Request $request
         *
         * @return Response
         */
        public function store(Request $request)
        {
            dd($request);
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function show($city, $category)
        {

            /*
             * Определяем город
             */

            $city = City::where('ascii_name', $city)->firstOrFail();

            /*
             * Все категории
             */

            $categoryList = Cache::remember('categoryList', 60, function () {
                return Category::MainCategory()->with('getSubCategory')->get();
            });


            /*
             *  Близлежащие города
             */


            $locationCity = Cache::remember('locationCity-' . $city->country_id, 60, function () use ($city) {
                return City::where('country_id', $city->country_id)->get();
            });


            /*
             * Выборка
             */

            $categoryMain = Category::find($category->category_id);
            if (is_null($categoryMain)) {
                $categoryMain = $category;
            }

            $categorySub = $categoryMain->getSubCategory()->get();


            $WhereCategory = [];
            foreach ($categorySub as $value) {
                $WhereCategory[] = $value->id;
            }


            /*
             * Если категория являеться главной, то бежим по всем, если же нет
             * то только по ней
             */

            if ($category == $categoryMain) {
                $WhereIn = $WhereCategory;
            } else {
                $WhereIn = [$category->id];
            }


            /*
             * Сама выборка
             */

            $advertisingList = Advertising::with('getImages', 'getCategory', 'getCity')
                ->where('city_id', $city->country_id)
                ->whereIn('category_id', $WhereIn)
                ->orderBy('id', 'DESC')
                ->simplePaginate(10);


            /*
             * Количество
             */


            $count_separated = implode(",", $WhereCategory);

            $CountAdvListAll = Cache::remember('CountAdvListAll' . $count_separated . 'City' . $city->country_id,
                60, function () use ($WhereCategory, $city) {
                    return Advertising::where('city_id', $city->country_id)
                        ->whereIn('category_id', $WhereCategory)
                        ->orderBy('id', 'DESC')
                        ->count();
                });


            return view('guest.category', [
                'categoryMain'    => $categoryMain,
                'categorySub'     => $categorySub,
                'advertisingList' => $advertisingList,
                'category'        => $category,

                'CountAdvListAll' => $CountAdvListAll,
                'categoryList'    => $categoryList,
                'locationCity'    => $locationCity,
            ]);


        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  Request $request
         * @param  int     $idcreated_at
         *
         * @return Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function destroy($id)
        {
            //
        }
    }
