@extends('layouts.app')

@section('main')



    <div class="intro-inner">
        <div class="about-intro" style="
    background:url(images/bg2.jpg) no-repeat center;
	background-size:cover;">
            <div class="dtable hw100">
                <div class="dtable-cell hw100">
                    <div class="container text-center">
                        <h1 class="intro-title animated fadeInDown"> ЧАСТО ЗАДАВАЕМЫЕ ВОПРОСЫ </h1>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="main-container inner-page">
        <div class="container">
            <div class="section-content">
                <div class="row ">
                    <h1 class="text-center title-1"> Памятка <strong>Пользователю</strong></h1>
                    <hr class="center-block small text-hr">
                </div>
                <div class="faq-content">
                    <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group faq-panel">
                        <div class="panel">
                            <div id="headingOne" role="tab" class="panel-heading">
                                <h4 class="panel-title">
                                    <a aria-controls="collapseOne" aria-expanded="true" href="faq.html#collapseOne"
                                       data-parent="#accordion" data-toggle="collapse" class="collapsed">
                                        Как разместить объявление?
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse"
                                 id="collapseOne" style="height: 0px;">
                                <div class="panel-body">
                                    Для размещения объявления необходимо с начало зарегистрироваться (Это займёт не
                                    более 3 минут),
                                    и нажать на кнопку "Подать Объявление".
                                    <br><br>
                                    Заполните все необходимые поля информации, а так же выбрать категорию, свой
                                    город\регион.
                                    Так же вы можете загрузить фотографии для того что бы ваше предложение смотрелось
                                    качественнее.
                                    <br><br>
                                    Контактная информация может отличаться, от указанной в личном профиле. Вы можете
                                    оформлять объявление на своих родственников или друзей.
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div id="headingTwo" role="tab" class="panel-heading">
                                <h4 class="panel-title">
                                    <a aria-controls="collapseTwo" aria-expanded="false" href="faq.html#collapseTwo"
                                       data-parent="#accordion" data-toggle="collapse" class="">
                                        Сколько стоит разместить объявление?
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse in"
                                 id="collapseTwo" style="height: auto;">
                                <div class="panel-body">
                                    Сайт «Доска объявлений» не взымает платы со стороны пользователей за размещение
                                    объявлений.
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div id="headingThree" role="tab" class="panel-heading">
                                <h4 class="panel-title">
                                    <a aria-controls="collapseThree" aria-expanded="false" href="faq.html#collapseThree"
                                       data-parent="#accordion" data-toggle="collapse" class="collapsed">
                                        Если я опубликовать объявление, я буду также получить больше спама электронной
                                        почты?
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse"
                                 id="collapseThree">
                                <div class="panel-body">
                                    Ваш электронный адрес не будет открыто опубликован. <br>
                                    Установка первоначальной связи происходит через электронную почту осуществляется
                                    через сайт «Доска объявлений» <br>
                                    Вам будет прислано сообщение, о том, что вашим объявлением заинтересовались с
                                    возможностью обратной связи.
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div id="heading_04" role="tab" class="panel-heading">
                                <h4 class="panel-title">
                                    <a aria-controls="collapse_04" aria-expanded="false" href="faq.html#collapse_04"
                                       data-parent="#accordion" data-toggle="collapse" class="collapsed">
                                        Как долго будет мое объявление остаются на сайте?
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="heading_04" role="tabpanel" class="panel-collapse collapse"
                                 id="collapse_04">
                                <div class="panel-body">
                                    Продолжительность публикации зависит от многих критериев, но средняя
                                    продолжительность составляет от двух недель до месяца
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div id="heading_05" role="tab" class="panel-heading">
                                <h4 class="panel-title">
                                    <a aria-controls="collapse_05" aria-expanded="false" href="faq.html#collapse_05"
                                       data-parent="#accordion" data-toggle="collapse" class="collapsed">
                                        Я продал свой продукт. Как удалить объявление?
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="heading_05" role="tabpanel" class="panel-collapse collapse"
                                 id="collapse_05">
                                <div class="panel-body">
                                    В личном кабинете пользователя, вы можете удалить своё объявление. <br>
                                    Оно будет перемещено в архив и не будет показываться пользователям. <br>
                                    В архиве, вы можете либо окончательно удалить объявление, либо напротив восстановить
                                    его.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="parallaxbox about-parallax-bottom">
        <div class="container">
            <div class="row text-center featuredbox">
                <div class="col-sm-4 xs-gap">
                    <div class="inner">
                        <div class="icon-box-wrap"><i class="icon-book-open ln-shadow-box shape-3"></i></div>
                        <h3 class="title-4">ОБСЛУЖИВАНИЕ КЛИЕНТОВ</h3>

                        <p>
                            Мы стараемся помочь каждому пользователю, не важно купить или продать товар.
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 xs-gap">
                    <div class="inner">
                        <div class="icon-box-wrap"><i class=" icon-lightbulb ln-shadow-box shape-6"></i></div>
                        <h3 class="title-4">ПРОВЕРЕННЫЕ ПАРТНЁРЫ</h3>

                        <p>Мы будем рады сотрудничать по многим вопросам, для того, что бы работать с нами было ещё
                            удобнее.</p>
                    </div>
                </div>
                <div class="col-sm-4 xs-gap">
                    <div class="inner">
                        <div class="icon-box-wrap"><i class="icon-megaphone ln-shadow-box shape-5"></i></div>
                        <h3 class="title-4">ЛУЧШИЕ ПРЕДЛОЖЕНИЯ </h3>

                        <p>Наши предложения, публикуют только сами пользователи, по этому они обладают самой актуальной
                            информацией.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection