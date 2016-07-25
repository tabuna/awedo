<?php

    namespace App\Http\Controllers\Account;

    use App\Http\Controllers\Controller;
    use App\Http\Requests;
    use App\Http\Requests\Account\AdvertisingRequest;
    use App\Models\Advertising;
    use App\Models\Category;
    use App\Models\City;
    use App\Models\Country;
    use App\Models\Images;
    use Auth;
    use Cache;
    use Flash;
    use Gate;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Image;
    use Session;


    class AdvertisingController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            $advertisingList = Advertising::with('getImages',
                'getCategory')->whereUserId(Auth::user()->id)->paginate(15);

            return view('account.advertisingIndex', [
                'advertisingList' => $advertisingList,
            ]);

        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {

            $categoryList = Cache::remember('categoryList', 60, function () {
                return Category::MainCategory()->with('getSubCategory')->get();
            });


            $countryList = Cache::remember('countryList', 60, function () {
                return Country::all();
            });



            return view('account.advertisingCreate', [
                'categoryList' => $categoryList,
                'countryList'  => $countryList,
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  Request $request
         *
         * @return Response
         */
        public function store(AdvertisingRequest $request)
        {
            $advertising = new Advertising($request->all());
            $advertising->user_id = Auth::user()->id;
            $advertising->save();


            foreach ($request->file('images') as $file) {
                if (!is_null($file)) {


                    /*
                     * Тут должна быть ресайз изоюражений и их уменьшение качества
                     */

                    $file->move(public_path() . '/adv/' . date("Y-m-d") . '/' . date("H"),
                        Str::ascii(time() . '-' . $file->getClientOriginalName()));

                    /*
                    $name = public_path() . '/adv/' . date("Y-m-d") . '/' . date("H"). Str::ascii(time() . '-' . $file->getClientOriginalName());

                    $img = Image::make($file)
                        ->resize(300, 200)
                        ->save($name,60);
                    */

                    $image = new Images([
                        'advertising_id' => $advertising->id,
                        'path'           => '/adv/' . date("Y-m-d") . '/' . date("H"),
                        'name'           => Str::ascii(time() . '-' . $file->getClientOriginalName()),
                        'finish'         => true,
                    ]);
                    $image->save();
                }
            }


            Flash::success('Вы успешно добавили объявление');

            return redirect('/');
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function show($id)
        {
            //
        }


        /**
         * @param Advertising $advertising
         *
         * @return \Illuminate\View\View
         */
        public function edit(Advertising $advertising)
        {
            //Может ли человек сюда заходить
            $this->authorize($advertising);
            $advertising->images = $advertising->getImages()->get();


            $categoryList = Cache::remember('categoryList', 60, function () {
                return Category::MainCategory()->with('getSubCategory')->get();
            });

            $countryList = Cache::remember('countryList', 60, function () {
                return Country::all();
            });


            $cityList = Cache::remember('cityList', 60, function () {
                return City::all();
            });


            return view('account.advertisingEdit', [
                'advertising'  => $advertising,
                'categoryList' => $categoryList,
                'countryList'  => $countryList,
                'cityList'     => $cityList,
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param AdvertisingRequest $request
         * @param Advertising        $advertising
         */
        public function update(AdvertisingRequest $request, Advertising $advertising)
        {
            $this->authorize($advertising);
            $advertising->fill($request->all());
            $advertising->save();
            Flash::success('Вы успешно обновили обьявление');

            return redirect()->route('advertising.index');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  Advertising $advertising
         *
         * @return Response
         */
        public function destroy(Advertising $advertising)
        {
            if ($advertising->user_id == Auth::user()->id) {
                $advertising->delete();
                Flash::success('Вы успешно удалили обьявление');

                return redirect()->route('advertising.index');
            } else {
                abort(404);
            }
        }
    }
