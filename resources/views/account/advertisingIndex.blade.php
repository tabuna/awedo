@extends('layouts.app')

@section('main')

    <div class="main-container">

        <div class="container">
            <div class="row">
                @include('layouts.AccountSidebar')

                <div class="col-sm-9 page-content">


                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-docs"></i> Мои обьявления </h2>

                        @include('flash::message')

                        <div class="table-responsive">

                            <table class="table table-striped table-bordered add-manage-table table demo footable-loaded footable"
                                   data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                <tr>
                                    <th> Изображение</th>
                                    <th> Заголовок</th>
                                    <th> Цена</th>
                                    <th> Управление</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($advertisingList as $adv)
                                    <tr>
                                        <td style="width:14%" class="add-img-td"><a
                                                    href="{{route('category.advertising.show',[$adv->getCategory->slug,$adv->id])}}"><img
                                                        class="thumbnail  img-responsive"
                                                        src="@if(is_null($adv->getImages->first())) /images/noimage.jpg @else {{$adv->getImages->first()->path .'/'. $adv->getImages->first()->name}} @endif"
                                                        alt="img"></a></td>
                                        <td style="width:58%" class="ads-details-td">
                                            <div>
                                                <p><strong>
                                                        <a href="{{route('category.advertising.show',[$adv->getCategory->slug,$adv->id])}}">{{$adv->title}}</a>
                                                    </strong></p>

                                                <p><strong> Опубликован </strong>:
                                                    {{$adv->created_at}} </p>

                                                <p><strong>Просмотров </strong>: {{$adv->visits}} </p>
                                            </div>
                                        </td>
                                        <td style="width:16%" class="price-td">
                                            <div><strong> <i class="fa fa-rub"></i> {{$adv->price}}</strong></div>
                                        </td>
                                        <td style="width:10%" class="action-td">
                                            <div>
                                                <form action="{{route('advertising.destroy',$adv->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {!! csrf_field() !!}

                                                    <p>
                                                        <button type="submit"
                                                      class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i>
                                                            Удалить
                                                        </button>
                                                    </p>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection