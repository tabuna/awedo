@extends('layouts.app')

@section('main')




    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 login-box">
                    <div class="panel panel-default">
                        <div class="panel-intro text-center">
                            <h2 class="logo-title">

                                <span class="logo-icon"><i
                                            class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span> BOOT<span>CLASSIFIED </span>
                            </h2>
                        </div>
                        <div class="panel-body">


                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif


                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Упс!</strong> Обнаруженны следующие проблемы:<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form role="form" method="POST" action="{{ url('/password/reset') }}">
                                <div class="form-group">
                                    <label for="sender-email" class="control-label">Email:</label>

                                    <div class="input-icon"><i class="icon-user fa"></i>
                                        <input type="email" placeholder="Email"
                                               name="email" value="{{ old('email') }}" required
                                               class="form-control email">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="user-pass" class="control-label">Пароль:</label>

                                    <div class="input-icon"><i class="icon-lock fa"></i>
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Пароль" required=>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="user-pass" class="control-label">Повторите пароль:</label>

                                    <div class="input-icon"><i class="icon-lock fa"></i>
                                        <input type="password" placeholder="Повторите пароль"
                                               name="password_confirmation" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Send me my password
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <p class="text-center "><a href="{{url('auth/login')}}"> Back to Login </a></p>

                            <div style=" clear:both"></div>
                        </div>
                    </div>
                    <div class="login-box-btm text-center">
                        <p> Don't have an account? <br>
                            <a href="{{url('auth/register')}}"><strong>Sign Up !</strong> </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


