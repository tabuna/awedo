<div class="col-sm-3 page-sidebar">
    <aside>
        <div class="inner-box">
            <div class="user-panel-sidebar">
                <div class="collapse-box">
                    <h5 class="collapse-title no-border"> Мои настройки <a href="account-home.html#MyClassified"
                                                                           data-toggle="collapse" class="pull-right"><i
                                    class="fa fa-angle-down"></i></a></h5>

                    <div class="panel-collapse collapse in" id="MyClassified">
                        <ul class="acc-list">
                            <li><a class="{{Active::route('settings.*')}}" href="{{route('settings.index')}}"><i
                                            class="fa fa-cog"></i> Настройки
                                </a></li>
                        </ul>
                    </div>
                </div>

                <div class="collapse-box">
                    <h5 class="collapse-title"> Мои обьявления <a href="account-home.html#MyAds" data-toggle="collapse"
                                                                  class="pull-right"><i
                                    class="fa fa-angle-down"></i></a></h5>

                    <div class="panel-collapse collapse in" id="MyAds">
                        <ul class="acc-list">
                            <li><a class="{{Active::route('advertising.*')}}" href="{{route('advertising.index')}}"><i
                                            class="fa fa-th-large"></i> Мои обьявления <span
                                            class="badge">{{Auth::user()->getAdvertising()->count()}}</span> </a></li>
                            <li><a class="{{Active::route('archive.*')}}" href="{{route('archive.index')}}"><i
                                            class="fa fa-folder"></i> Архив <span
                                            class="badge"></span></a></li>
                        </ul>
                    </div>
                </div>

                <div class="collapse-box">
                    <h5 class="collapse-title"> Сеанс <a href="account-home.html#TerminateAccount"
                                                         data-toggle="collapse" class="pull-right"><i
                                    class="fa fa-angle-down"></i></a></h5>

                    <div class="panel-collapse collapse in" id="TerminateAccount">
                        <ul class="acc-list">
                            <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out"></i> Выйти </a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </aside>
</div>
