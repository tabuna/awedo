@extends('layouts.app')


@section('title', $category->name  .' | '. $GeoCity->name  .' | Доска Объявлений')
@section('description', $category->name  .' | '.  $GeoCity->name   .' | Доска Объявлений')

<meta name="keywords"
      content="@yield('keywords',
      $category->name.',объявления,бесплатные объявления,доска объявлений,частные объявления,подам объявление,подать объявление, в ' . $GeoCity->name)">



@section('main')



    <div class="search-row-wrapper">
        <div class="container ">
            <form action="{{route('search.index')}}" method="GET">
                <div class="col-sm-4">
                    <input class="form-control keyword" name="query" type="text" required placeholder="Я ищу ..."
                           min="3" max="255">
                </div>
                <div class="col-sm-4">
                    <div class="selecter" tabindex="0">


                        <select name="category_id"
                                class="form-control selecter">
                            @foreach($categorySub as $value)

                                <option value="{{$value->id}}"
                                        @if($value->id == $category->id) selected @endif>{{$value->name}}</option>
                            @endforeach
                        </select>


                    </div>
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-block btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>




    <div class="main-container">


        @if (Session::has('flash_notification.message'))
            <div class="container">
                <div class="row">
                    <div class="col-md-12 page-content">
                        <div class="inner-box category-content">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div class="alert alert-{{ Session::get('flash_notification.level') }} pgray  alert-lg"
                                         role="alert">
                                        <h2 class="no-margin no-padding">{{ Session::get('flash_notification.message') }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif




    <div class="container">
            <div class="row">


                <div class="col-sm-3 page-sidebar">
                    <aside>
                        <div class="inner-box">

                            <div class="categories-list  list-filter">
                                <h5 class="list-title"><strong><a href="{{url('/')}}"><i class="fa fa-angle-left"></i>
                                            Все категории</a></strong></h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{route('city.category.show',[strtolower($GeoCity->ascii_name),$categoryMain->slug])}}"><span
                                                    class="title"><strong>{{$categoryMain->name}}</strong></span><span
                                                    class="count">&nbsp; {{number_format($CountAdvListAll, 0, ',', ' ')}}</span></a>
                                        <ul class="list-unstyled long-list">


                                            @foreach($categorySub as $value)
                                                <li><a class="{{Active::path('category/'.$value->slug)}}"
                                                       href="{{route('city.category.show',[strtolower($GeoCity->ascii_name),$value->slug])}}">
                                                        {{$value->name}}</a></li>
                                            @endforeach

                                        </ul>
                                    </li>
                                </ul>
                            </div>


                        </div>

                    </aside>
                </div>

                <div class="col-sm-9 page-content col-thin-left">
                    <div class="category-list">

                        <div class="adds-wrapper">
                            <div class="tab-content">
                                <div class="tab-pane active" id="allAds">


                                    @foreach($advertisingList as $ads)
                                        <div class="item-list">
                                        <div class="col-sm-2 no-padding photobox">
                                            <div class="add-image"><span class="photo-count"><i
                                                            class="fa fa-camera"></i> {{count($ads->getImages)}} </span>
                                                <a
                                                        href="{{route('city.category.advertising.show',[strtolower($GeoCity->ascii_name),$category->slug,$ads->id])}}"><img
                                                            class="thumbnail no-margin"
                                                            src="@if(is_null($ads->getImages->first())) /images/noimage.jpg @else{{$ads->getImages->first()->path .'/'. $ads->getImages->first()->name}}@endif"
                                                                                     alt="img"></a></div>
                                        </div>

                                        <div class="col-sm-7 add-desc-box">
                                            <div class="add-details">
                                                <h5 class="add-title"><a
                                                            href="{{route('city.category.advertising.show',[strtolower($GeoCity->ascii_name),$category->slug,$ads->id])}}">
                                                        {{$ads->title}} </a></h5>

                                                <p>{{str_limit($ads->description, $limit = 55, $end = '...')}}</p>
                                                <span class="info-row"><span
                                                            class="date"><i
                                                                class="fa fa-clock-o"></i> {{$ads->created_at->diffForHumans() }} </span> &nbsp;  <span
                                                            class="category"><i
                                                                class="fa fa-tag"></i> {{$ads->getCategory->name}} </span> &nbsp;  <span
                                                            class="item-location"><i
                                                                class="fa fa-map-marker"></i> {{$ads->getCity->name}} </span> </span>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 text-right  price-box">
                                            <h2 class="item-price"><i
                                                        class="fa fa-rub"></i> {{ number_format($ads->price, 0, ',', ' ')}}
                                            </h2>

                                        </div>

                                    </div>
                                    @endforeach

                                </div>
                                <div class="tab-pane" id="businessAds"></div>
                                <div class="tab-pane" id="personalAds"></div>
                            </div>
                        </div>

                    </div>
                    <div class="pagination-bar text-center">

                        <nav>
                            <ul class="pager">

                                @if(!$advertisingList->currentPage())
                                    <li class="previous"><a href="{{$advertisingList->previousPageUrl()}}"><span
                                                aria-hidden="true">&larr;</span>
                                        Назад</a></li>
                                @endif

                                @if($advertisingList->hasMorePages())
                                    <li class="next"><a href="{{$advertisingList->nextPageUrl()}}">Дальше <span
                                                    aria-hidden="true">&rarr;</span></a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>

                    <div class="post-promo text-center">
                        <h2> Есть что нибудь для продажи? </h2>
                        <h5>Продавать свои товары онлайн бесплатно. Это проще, чем вы думаете!</h5>

                        @if(Auth::check())
                        <a href="{{route('advertising.create')}}" class="btn btn-lg btn-border btn-post btn-danger">Подать
                            объявление</a>
                        @else
                            <a href="{{url('/auth/register')}}" class="btn btn-lg btn-border btn-post btn-danger">Подать
                                объявление</a>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>




@endsection