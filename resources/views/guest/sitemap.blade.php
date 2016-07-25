@extends('layouts.app')

@section('main')




    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-offset-2 col page-content col-thin-right">
                    <div class="inner-box category-content">
                        <h2 class="title-2">Объявления в моём городе </h2>
                        <div class="row">
                            <div class="col-md-12 site-map-li">
                                @foreach($AllCity as $key => $value)
                                    <li>
                                        <a href="{{route('city.show',strtolower($value->ascii_name))}}">{{$value->name}}</a>
                                    </li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
