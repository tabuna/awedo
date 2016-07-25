<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="/assets/ico/favicon.png">

    <title>@yield('title','Доска Объявлений')</title>
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta name="description"
          content="@yield('description','Сайт бесплатных объявлений. Город ' . $GeoCity->name  )">
    <meta name="keywords"
          content="@yield('keywords','объявления,бесплатные объявления,доска объявлений,частные объявления,подам объявление,подать объявление,город ' . $GeoCity->name)">
    <meta property="og:title" content="@yield('title','Доска Объявлений' )">
    <meta property="og:description"
          content="@yield('description','Сайт бесплатных объявлений. Город ' . $GeoCity->name )">
    <meta property="og:image" content="@yield('avatar')">
    <meta name="twitter:title" content="@yield('title','Доска Объявлений')">
    <meta name="twitter:description"
          content="@yield('description','Сайт бесплатных объявлений. Город ' . $GeoCity->name )"/>
    <meta name="twitter:image:src" content="@yield('avatar')"/>


    <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/assets/plugins/bxslider/jquery.bxslider.css" rel="stylesheet"/>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
    <div class="header">
        <nav class="navbar navbar-site navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span></button>
                    <a href="{{ url('/') }}" class="navbar-brand logo logo-title">

                        <span class="logo-icon"><i class="fa fa-search ln-shadow-logo shape-0"></i> </span>
                        Доска<span>Объявлений </span> </a></div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">


                        <li><a href="#" data-toggle="modal"
                               data-target=".cityModal">{{$GeoCity->name}} <i class=" icon-map"></i></a></li>

                    @if(Auth::check())
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>{{Auth::user()->name}} {{Auth::user()->lastname}}</span> <i
                                            class="fa fa-user"></i></a>
                                <ul class="dropdown-menu user-menu">
                                    <li class="{{Active::route('settings.*')}}"><a href="{{route('settings.index')}}"><i
                                                    class="fa fa-home"></i>
                                            Профиль </a></li>
                                    <li class="{{Active::route('advertising.*')}}"><a
                                                href="{{route('advertising.index')}}"><i class="fa fa-th-large"></i> Мои
                                            обьявления </a></li>
                                    <li class="{{Active::route('archive.*')}}"><a href="{{route('archive.index')}}"><i
                                                    class="fa fa-folder"></i> Архив </a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{url('auth/logout')}}"><i class="fa fa-sign-out"></i> Выйти </a></li>

                                </ul>
                            </li>

                            <li class="postadd"><a class="btn btn-block   btn-border btn-post btn-danger"
                                                   href="{{ route('advertising.create') }}">Подать объявление</a></li>
                        @else
                            <li><a href="{{ url('/auth/login') }}">Войти</a></li>
                            <li><a href="{{ url('/auth/register') }}">Зарегистрироваться</a></li>
                            <li class="postadd"><a class="btn btn-block   btn-border btn-post btn-danger"
                                                   href="{{ url('/auth/register') }}">Подать объявление</a></li>
                        @endif

                    </ul>
                </div>

            </div>

        </nav>
    </div>

    @yield('main')

    <div class="footer" id="footer">
        <div class="container">
            <ul class=" pull-left navbar-link footer-nav">
                <li>
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Главная </a>
                    <a href="{{ route('about.index') }}"><i class="fa fa-users"></i> О нас </a>
                    <a href="{{ route('rules.index') }}"><i class="fa fa-exclamation-triangle"></i> Правила </a>
                    <a href="{{ route('faq.index') }}"><i class="fa fa-life-ring"></i> Помощь </a>
                    <a href="{{ route('sitemap.index') }}"><i class="fa fa-sitemap"></i> Карта сайта </a>

                </li>
            </ul>
            <ul class=" pull-right navbar-link footer-nav">
                <li><i class="fa fa-copyright"></i> 2015 Доска Объявлений</li>
            </ul>
        </div>
    </div>

</div>


<div class="modal cityModal fade" id="selectRegion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="exampleModalLabel"><i class=" icon-map"></i> Выберите свой регион</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">

                        <div style="clear:both"></div>
                        <div class="col-sm-12 no-padding">


                            <select id="country_id" name="country_id"
                                    class="form-control selecter">
                                <option selected disabled>Выберите область ...</option>
                                @foreach($countryList as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>


                        </div>
                        <div style="clear:both"></div>
                        <hr class="hr-thin">
                    </div>
                    <div id="countryListSelect">
                        <div class="col-md-4">
                            <ul class="list-link list-unstyled" id="countryListSelect-1">
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-link list-unstyled" id="countryListSelect-2">
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-link list-unstyled" id="countryListSelect-3">
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/bootstrap/js/jasny-bootstrap.min.js"></script>

<script src="/assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js"></script>
<script src="/assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js"></script>

<script src="/assets/plugins/bxslider/jquery.bxslider.min.js"></script>
<script>
    $('.bxslider').bxSlider({
        pagerCustom: '#bx-pager'
    });

    $('.selecter').selecter();

</script>
<script type="text/javascript">

    /*
     //Шаблончик для списка option
     function selectElems(id, name){
     var option = "<option value='"+id+"'>";
     option += name;
     option += "</optin>";
     return option;
     }
     //Шаблон для красивого списка
     function selecterSelected(id, name){
     var span = '<span class="selecter-item" data-value="'+id+'">';
     span += name;
     span += '</span>';
     return span;
     }
     */
    $(document).ready(function(){
        $("#country_id").change(function(){
            //Запрпашиваем города
            //region-state
            var obj = $(this);
            var currentId = $('option:selected',obj).val();
            $.ajax({
                type: "GET",
                url: "/townslist/stowns/"+currentId,
                dataType: 'json',
                //data: currentId,
                success: function(data){
                    var list = '';
                    for (var i = 0; i < data[0].length; i++) {
                        list += "<li><a href='/city/" + data[0][i].id + "'>" + data[0][i].name + "</a></li>";
                    }
                    $("#countryListSelect-1").html(list);
                    var list = '';
                    for (var i = 0; i < data[1].length; i++) {
                        list += "<li><a href='/city/" + data[1][i].id + "'>" + data[1][i].name + "</a></li>";
                    }
                    $("#countryListSelect-2").html(list);
                    var list = '';
                    for (var i = 0; i < data[2].length; i++) {
                        list += "<li><a href='/city/" + data[2][i].id + "'>" + data[2][i].name + "</a></li>";
                    }
                    $("#countryListSelect-3").html(list);
                    /*
                     var elem = '';
                     var visElem = '';
                     for(var i = 0; i < data.length; i++){
                     elem += selectElems(data[i].id, data[i].name);
                     visElem += selecterSelected(data[i].id, data[i].name);
                     }
                     $("#region-state").html(elem);
                     $("#region-state").parent().find("span.selecter-selected").html(data[0].name);
                     $("#region-state").parent().find(".scroller .scroller-content").html(visElem);
                     */
                }
            });
        });
        $("#selector-country_id").change(function () {
            //Запрпашиваем города
            //region-state
            var obj = $(this);
            var currentId = $('option:selected', obj).val();
            $.ajax({
                type: "GET",
                url: "/townslist/city/" + currentId,
                dataType: 'json',
                //data: currentId,
                success: function (data) {
                    $('#city_id').html('');
                    $.each(data, function (key, value) {
                        $('#city_id')
                                .append($("<option></option>")
                                        .attr("value", value.id)
                                        .text(value.name));
                    });
                    $('option:selected', obj).remove();
                    $("#city_id").attr('disabled',false);
                    // $('.deleteSub div').remove();
                    // $('.deleteSub span').remove();
                    //  $('#city_id').appendTo('.deleteSub');
                    // $('.deleteSub').remove();
                    //   $('#city_id').prop('disabled', false);
                    /*
                     $('#city_id').selecter({
                     customClass: "deleteSub"
                     });*/
                }
            });
        });
    });
</script>

<script>

    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-39757298-3', 'auto');
    ga('send', 'pageview');

</script>


</body>
</html>
