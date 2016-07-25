<?php

    namespace App\Http\Controllers\Guest;

    use App\Http\Controllers\Controller;
    use App\Http\Requests;
    use App\Http\Requests\FeedBackRequest;
    use App\Models\Advertising;
    use App\Models\Category;
    use Flash;
    use Mail;

    class AdvertisingController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
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
        public function store()
        {

        }

        /**
         * Display the specified resource.
         *
         * @param  $category $advertising
         *
         * @return \Illuminate\Http\Response
         */
        public function show($city, $category, $advertising)
        {
            $advertising->visits++;
            $advertising->save();

            return view('guest.adv', [
                'category'    => $category,
                'advertising' => $advertising,
            ]);
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
        public function update(FeedBackRequest $request, Category $category, Advertising $advertising)
        {
            Mail::send('emails.feedback', ['request' => $request->all()], function ($message) use ($advertising) {
                $message
                    ->from('noreply@awedo.ru')
                    ->to($advertising->email)
                    ->subject('Вашим объявлением заинтересовались');
            });

            Flash::success('Вы успешно отправили сообщение');

            return redirect()->back();
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
