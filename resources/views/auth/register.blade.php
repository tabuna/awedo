@extends('layouts.app')

@section('main')






    <div class="main-container">


        <div class="container">
            <div class="row">
                <div class="col-md-8 page-content">
                    <div class="inner-box category-content">
                        <h2 class="title-2"><i class="icon-user-add"></i> Зарегистрируйтесь, это бесплатно </h2>

                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{ url('/auth/register') }}">


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


                                    <fieldset>

                                        <div class="form-group required">
                                            <label class="col-md-4 control-label">Имя <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input name="name" value="{{old('name')}}" placeholder="Имя"
                                                       class="form-control input-md" required="" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group required">
                                            <label class="col-md-4 control-label">Фамилия <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input name="lastname" value="{{old('lastname')}}"
                                                       placeholder="Фамилия"
                                                       class="form-control input-md" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group required">
                                            <label class="col-md-4 control-label">Номер телефона <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input name="phone" value="{{old('phone')}}" placeholder="Номер телефона"
                                                       class="form-control input-md" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Пол</label>

                                            <div class="col-md-6">
                                                <div class="radio">
                                                    <label for="Gender-0">
                                                        <input name="gender" id="Gender-0" value="0" checked="checked"
                                                               type="radio">
                                                        Мужчина </label>
                                                </div>
                                                <div class="radio">
                                                    <label for="Gender-1">
                                                        <input name="gender" id="Gender-1" value="1" type="radio">
                                                        Женщина </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group required">
                                            <label for="inputEmail3" class="col-md-4 control-label">Email
                                                <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input type="email" class="form-control" name="email"
                                                       value="{{old('email')}}"
                                                       placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label for="password" class="col-md-4 control-label">Пароль </label>

                                            <div class="col-md-6">
                                                <input type="password" name="password" class="form-control"
                                                       placeholder="Пароль">
                                            </div>
                                        </div>

                                        <div class="form-group required">
                                            <label for="password_confirmation" class="col-md-4 control-label">Повторите пароль
                                                 </label>

                                            <div class="col-md-6">
                                                <input type="password" name="password_confirmation" class="form-control"
                                                       required placeholder="Повторите пароль">

                                                <p class="help-block">Минимум 6 знаков </p>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-4 control-label"></label>

                                            <div class="col-md-8">
                                                <div class="termbox mb10">
                                                    <label class="checkbox-inline" for="terms">
                                                        <input name="terms" value="1" type="checkbox">
                                                        Я подтверждаю своё согласие с условиями<a href="{{route('rules.index')}}"> пользовательского соглашения</a> </label>
                                                </div>
                                                <div style="clear:both"></div>

                                                {!! csrf_field() !!}
                                                <button class="btn btn-primary" type="submit">Зарегистрироваться</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 reg-sidebar">
                    <div class="reg-sidebar-inner text-center">
                        <div class="promo-text-box"><i class=" icon-picture fa fa-4x icon-color-1"></i>

                            <h3><strong>Разместить объявление бесплатно</strong></h3>

                            <p> Разместить бесплатные объявления как частное лицо или компания. </p>
                        </div>
                        <div class="promo-text-box"><i class=" icon-pencil-circled fa fa-4x icon-color-2"></i>

                            <h3><strong>Создание и Управление элементами</strong></h3>

                            <p> Интуитивно понятное и быстрое управление любыми вашими обьявлениями</p>
                        </div>
                        <div class="promo-text-box"><i class="  icon-heart-2 fa fa-4x icon-color-3"></i>

                            <h3><strong>Создание списка избранных объявления.</strong></h3>

                            <p> Сохраняйте интересные Вам обьявления, что бы вернуться позже</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
