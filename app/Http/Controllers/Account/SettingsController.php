<?php

    namespace App\Http\Controllers\Account;

    use App\Http\Controllers\Controller;
    use App\Http\Requests;
    use Auth;
    use Illuminate\Http\Request;
    use Session;

    class SettingsController extends Controller
    {


        private $user;

        public function __construct()
        {
            $this->user = Auth::user();
        }


        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            return view('account.settings', [
                'User' => $this->user,
            ]);
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
            //
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
         * @param  int     $id
         *
         * @return Response
         */
        public function update(Request $request, $id)
        {
            if ($request->type == 'personal') {
                $this->user->fill($request->all())->save();
            } elseif ($request->type == 'password') {
                $this->user->password = bcrypt($request->password);
                $this->user->save();
            }
            Session::flash('good', 'Вы успешно изменили значения');

            return redirect()->back();
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
