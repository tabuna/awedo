@extends('layouts.app')

@section('main')





    <div class="main-container">
        <div class="container">
            <div class="row">


                @include('layouts.AccountSidebar')


                <div class="col-sm-9 page-content">

                    <div class="inner-box">
                        <div class="welcome-msg">
                            <h3 class="page-sub-header2 clearfix no-padding">Здравствуйте {{$User->name}} </h3>
                        </div>


                        <div id="accordion" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB1" data-toggle="collapse"> Личные
                                            данные </a></h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseB1">
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="post"
                                              action="{{URL::route('settings.update')}}">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Имя</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name"
                                                           value="{{$User->name}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Фамилия</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="lastname"
                                                           value="{{$User->lastname}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Email</label>

                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" name="email"
                                                           value="{{$User->email}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Phone" class="col-sm-3 control-label">Телефон</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="phone"
                                                           value="{{$User->phone}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-default">Изменить</button>
                                                </div>
                                            </div>

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="type" value="personal">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB2" data-toggle="collapse"
                                                               class="collapsed">
                                            Безопасность </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseB2" style="height: 0px;">
                                    <div class="panel-body">
                                        <form class="form-horizontal" method="post" role="form"
                                              action="{{URL::route('settings.update')}}">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Новый пароль</label>

                                                <div class="col-sm-9">
                                                    <input type="password" name="password" class="form-control"
                                                           placeholder="******">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Повторите пароль</label>

                                                <div class="col-sm-9">
                                                    <input type="password" name="password_confirmation"
                                                           class="form-control"
                                                           placeholder="******">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-default">Изменить</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" class="form-control" name="type" value="password">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>

    </div>






@endsection
