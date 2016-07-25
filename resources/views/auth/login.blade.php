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
                                            class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span>
                                Доска<span>Объявлений</span></h2>
                        </div>
                        <div class="panel-body">


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


                            <form role="form" method="POST" action="{{ url('/auth/login') }}">
                                <div class="form-group">
                                    <label for="sender-email" class="control-label">Email:</label>

                                    <div class="input-icon"><i class="icon-user fa"></i>
                                        <input id="sender-email" placeholder="Email" type="email" name="email"
                                               value="{{ old('email') }}" required class="form-control email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user-pass" class="control-label">Пароль:</label>

                                    <div class="input-icon"><i class="icon-lock fa"></i>
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Пароль"
                                               required id="user-pass">
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-primary  btn-block">Войти</button>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <label class="checkbox pull-left">
                                <input type="checkbox" value="1" name="remember" id="remember">
                                Запомнить меня </label>

                            <p class="text-center pull-right"><a href="{{ url('/password/email') }}"> Забыли пароль? </a></p>

                            <div style=" clear:both"></div>
                        </div>
                    </div>
                    <div class="login-box-btm text-center">
                        <p> Неимеете аккаунта? <br>
                            <a href="{{ url('/auth/register') }}"><strong>Зарегистрироваться !</strong> </a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
