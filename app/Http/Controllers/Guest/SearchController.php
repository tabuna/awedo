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


    class SearchController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {

            /*
            * Сама выборка
            */

            $advertisingList = Advertising::with('getImages', 'getCategory', 'getCity')
                ->where('city_id', Session::get('GeoCity')->id)
                ->orWhere('category_id', $request->input('category_id'))
                ->search($request->input('query'))
                ->orderBy('id', 'DESC')
                ->simplePaginate(10);


            if (is_null($advertisingList->first())) {
                abort(404);
            } else {
                $category = Category::find($advertisingList->first()->category_id);
            }
            /*
             * Все категории
             */

            $categoryList = Cache::remember('categoryList', 60, function () {
                return Category::MainCategory()->with('getSubCategory')->get();
            });


            /*
             *  Близлежащие города
             */


            $locationCity = Cache::remember('locationCity', 60, function () {
                return City::where('country_id', Session::get('GeoCity')->country_id)->get();
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
             * Количество
             */


            $count_separated = implode(",", $WhereCategory);

            $CountAdvListAll = Cache::remember('CountAdvListAll' . $count_separated . 'City' . Session::get('GeoCity'),
                60, function () use ($WhereCategory) {
                    return Advertising::where('city_id', Session::get('GeoCity')->id)
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
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         *
         * @param  string $query
         *
         * @return \Illuminate\Http\Response
         */
        public function show($query)
        {
            dd($query);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         *
         * @return \Illuminate\Http\Response
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
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    }
