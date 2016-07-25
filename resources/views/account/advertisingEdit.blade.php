@extends('layouts.app')

@section('main')


    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-9 page-content">
                    <div class="inner-box category-content">
                        <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> Подать бесплатное объявление
                            </strong></h2>

                        <div class="row">
                            <div class="col-sm-12">


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


                                <form class="form-horizontal" action="{{route('advertising.update',$advertising->id)}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    <fieldset>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Категория</label>

                                            <div class="col-md-8">
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <option disabled selected="selected"> Выберите категорию ...
                                                    </option>


                                                    @foreach($categoryList as $value)

                                                        <optgroup label="{{$value->name}}">

                                                            @foreach($value->getSubCategory as $subValue)
                                                                <option value="{{$value->id}}"
                                                                        @if($advertising->category_id == $value->id) selected @endif >{{$subValue->name}}</option>
                                                            @endforeach
                                                        </optgroup>

                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Тип</label>

                                            <div class="col-md-8">
                                                <label class="radio-inline" for="radios-0">
                                                    <input name="type" id="type-0" value="0"
                                                           @if(!$advertising->type) checked="checked" @endif
                                                           type="radio">
                                                    Личный </label>
                                                <label class="radio-inline" for="radios-1">
                                                    <input name="type" id="type-1" value="1"
                                                           @if($advertising->type) checked="checked"
                                                           @endif  type="radio">
                                                    Бизнес </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="title">Заголовок</label>

                                            <div class="col-md-8">
                                                <input id="title" name="title" placeholder="Заголовок обьявления"
                                                       class="form-control input-md" required
                                                       value="{{$advertising->title}}" type="text">
                                                <span class="help-block">Не пишите в заголовке цену и контактную информацию — для этого есть отдельные поля — и не используйте слово «продам» </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="description">Описание</label>

                                            <div class="col-md-8">
                                                <textarea class="form-control" id="description" rows="10"
                                                          name="description"
                                                          placeholder="Подробно опишите ваш товар или услугу. Не указывайте в описании телефон и e-mail — для этого есть отдельные поля">{{$advertising->description}}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="price">Цена</label>

                                            <div class="col-md-8">
                                                <div class="input-group"><span class="input-group-addon"><i
                                                                class="fa fa-rub"></i></span>
                                                    <input id="price" name="price" value="{{$advertising->price}}"
                                                           class="form-control"
                                                           placeholder="Цена" required="" type="number" min="0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="textarea"> Изображения </label>


                                            <div class="col-md-8">


                                                <div class="fileinput fileinput-new input-group"
                                                     data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"><i
                                                                class="glyphicon glyphicon-file fileinput-exists"></i>
                                                        <span class="fileinput-filename"></span></div>
                                                    <span class="input-group-addon btn btn-default btn-file"><span
                                                                class="fileinput-new">Выбрать</span><span
                                                                class="fileinput-exists">Изменить</span><input
                                                                type="file" name="images[]"></span>
                                                    <a href="#"
                                                       class="input-group-addon btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput">Удалить</a>
                                                </div>


                                                <div class="fileinput fileinput-new input-group"
                                                     data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"><i
                                                                class="glyphicon glyphicon-file fileinput-exists"></i>
                                                        <span class="fileinput-filename"></span></div>
                                                    <span class="input-group-addon btn btn-default btn-file"><span
                                                                class="fileinput-new">Выбрать</span><span
                                                                class="fileinput-exists">Изменить</span><input
                                                                type="file" name="images[]"></span>
                                                    <a href="#"
                                                       class="input-group-addon btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput">Удалить</a>
                                                </div>


                                                <div class="fileinput fileinput-new input-group"
                                                     data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"><i
                                                                class="glyphicon glyphicon-file fileinput-exists"></i>
                                                        <span class="fileinput-filename"></span></div>
                                                    <span class="input-group-addon btn btn-default btn-file"><span
                                                                class="fileinput-new">Выбрать</span><span
                                                                class="fileinput-exists">Изменить</span><input
                                                                type="file" name="images[]"></span>
                                                    <a href="#"
                                                       class="input-group-addon btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput">Удалить</a>
                                                </div>


                                                <div class="fileinput fileinput-new input-group"
                                                     data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"><i
                                                                class="glyphicon glyphicon-file fileinput-exists"></i>
                                                        <span class="fileinput-filename"></span></div>
                                                    <span class="input-group-addon btn btn-default btn-file"><span
                                                                class="fileinput-new">Выбрать</span><span
                                                                class="fileinput-exists">Изменить</span><input
                                                                type="file" name="images[]"></span>
                                                    <a href="#"
                                                       class="input-group-addon btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput">Удалить</a>
                                                </div>


                                                <div class="fileinput fileinput-new input-group"
                                                     data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"><i
                                                                class="glyphicon glyphicon-file fileinput-exists"></i>
                                                        <span class="fileinput-filename"></span></div>
                                                    <span class="input-group-addon btn btn-default btn-file"><span
                                                                class="fileinput-new">Выбрать</span><span
                                                                class="fileinput-exists">Изменить</span><input
                                                                type="file" name="images[]"></span>
                                                    <a href="#"
                                                       class="input-group-addon btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput">Удалить</a>
                                                </div>


                                                <p class="help-block">Вы можете прикрепить не более 5 фотографий.
                                                    Пожалуйста используйте реальные изображения товара.</p>
                                            </div>
                                        </div>
                                        <div class="content-subheading"><i class="icon-user fa"></i> <strong>Контактная
                                                информация</strong></div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Имя</label>

                                            <div class="col-md-8">
                                                <input id="name" name="name"
                                                       placeholder="Имя продавца" value="{{$advertising->name}}"
                                                       class="form-control input-md" required="" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="seller-email"> Email</label>

                                            <div class="col-md-8">
                                                <input id="email" name="email" class="form-control"
                                                       placeholder="Email продавца" value="{{$advertising->email}}"
                                                       required="" type="email">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="seller-Number"> Телефон</label>

                                            <div class="col-md-8">
                                                <input id="phone" name="phone"
                                                       placeholder="Контактный телефон" value="{{$advertising->phone}}"
                                                       class="form-control input-md" required="" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="country_id">Область</label>

                                            <div class="col-md-8">
                                                <select id="country_id" name="country_id"
                                                        class="form-control">
                                                    <option selected disabled>Выберите область ...</option>
                                                    @foreach($countryList as $value)
                                                        <option value="{{$value->id}}"
                                                                @if($advertising->country_id == $value->id) selected @endif >{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="city_id">Город</label>

                                            <div class="col-md-8">
                                                <select id="city_id" name="city_id" class="form-control">
                                                    <option selected disabled>Выберите Город ...</option>
                                                    @foreach($cityList as $value)
                                                        <option value="{{$value->id}}"
                                                                data-country="{{$value->country_id}}"
                                                                @if($advertising->city_id == $value->id) selected @endif >{{$value->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Правила</label>

                                            <div class="col-md-8">
                                                <label class="checkbox-inline" for="checkboxes-0">
                                                    <input name="terms" id="terms"
                                                           value="1" type="checkbox">
                                                    Я подтверждаю своё согласие с условиями<a href="#">
                                                        пользовательского соглашения</a> </label>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>

                                            {!! csrf_field() !!}
                                            <input type="hidden" name="_method" value="PUT">

                                            <div class="col-md-8">
                                                <button id="button1id" type="submit"
                                                        class="btn btn-success btn-lg">Отправить
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 reg-sidebar">
                    <div class="reg-sidebar-inner text-center">
                        <div class="promo-text-box"><i class=" icon-picture fa fa-4x icon-color-1"></i>


                            <h3><strong>Разместить объявление бесплатно</strong></h3>

                            <p> Разместить бесплатные объявления как частное лицо или компания. </p>
                        </div>
                        <div class="panel sidebar-panel">
                            <div class="panel-heading uppercase">
                                <small><strong>КАК БЫСТРО ПРОДАТЬ?</strong></small>
                            </div>
                            <div class="panel-content">
                                <div class="panel-body text-left">
                                    <ul class="list-check">
                                        <li> Используйте краткое название и описание товара или услуги</li>
                                        <li> Убедитесь, что вы размещаете в правильной категории</li>
                                        <li> Добавте хорошие фотографии, чтобы ваше объявление смотрелось</li>
                                        <li> Предложите разумную цену</li>
                                        <li> Проверте перед публикацией</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <script>
        window.onload = function () {
            $("#country_id").change(function () {
                $("#city_id").prop('disabled', false);
                var activeCountry = $("#country_id").val();
                $("#city_id option").each(function () {

                    if ($(this).data('country') == activeCountry)
                        $(this).removeClass("hide");
                    else
                        $(this).addClass("hide");

                });
            });
        }
    </script>



@endsection
