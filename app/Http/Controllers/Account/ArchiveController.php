<?php

    namespace App\Http\Controllers\Account;

    use App\Http\Controllers\Controller;
    use App\Http\Requests;
    use Auth;
    use Flash;
    use Illuminate\Http\Request;

    class ArchiveController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $advertisingList = Auth::user()
                ->getAdvertising()
                ->onlyTrashed()
                ->paginate(15);

            return view('account.arhiveIndex', [
                'advertisingList' => $advertisingList,
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
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
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
            $advertising = Auth::user()
                ->getAdvertising()
                ->onlyTrashed()
                ->findOrFail($id)
                ->restore();

            Flash::success('Вы успешно востановили обьявление');

            return redirect()->route('archive.index');
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
            $advertising = Auth::user()
                ->getAdvertising()
                ->onlyTrashed()
                ->findOrFail($id)
                ->forceDelete();

            Flash::success('Вы успешно удалили обьявление');

            return redirect()->route('archive.index');
        }
    }
