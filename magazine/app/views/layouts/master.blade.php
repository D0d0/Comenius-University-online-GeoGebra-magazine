<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Prvý online GeoGebra magazín</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">
        {{HTML::extendedStyle('css/bootstrap.min.css')}}
        {{HTML::extendedStyle('css/bootstrap-minimit.min.css')}}
        {{HTML::extendedStyle('css/datepicker.min.css')}}
        {{HTML::extendedStyle('css/jquery-ui.min.css')}}
        {{HTML::extendedScript('js/jquery.min.js')}}
        {{HTML::extendedScript('js/bootstrap.min.js')}}
        {{HTML::extendedScript('js/moment.min.js')}}
        {{HTML::extendedScript('js/locales.min.js')}}
        {{HTML::extendedScript('js/datepicker.min.js')}}
        {{HTML::extendedScript('js/jquery-ui.min.js')}}
        @yield('js')
        <style>
            #datetimepicker .input-group-addon{
                background-color: #428bca;
                border: #AFCFFF;
            }
            
            .navbar .nav>li>a:hover, .navbar .nav>li>a:focus{
                background-color: #AFCFFF;
            }
            
            .navbar li {
                margin-top: 8px;
            }
            
            .navbar li:last-child{
                margin-top: 0px;
            }
            
            .navbar .dropdown-menu>li>a{
                color: #333;
            }
            
            [type=clanok] h3{
                margin-top: 0;
            }

            #extended_search{
                cursor: pointer;
            }
            
            .navbar .nav{
                background-color: #00A2E8;
            }
            
            .navbar .nav a, .navbar  .nav span{
                color: white;
                text-transform: uppercase;
            }
            
            .navbar{
                margin-bottom: 0px;
            }
            
            #hlavicka:hover{
                text-decoration: none;
            }

            @yield('style')
        </style>
        <script>
            $TAGS_URL = "{{ URL::action('HomeController@tags') }}";

            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('#datetimepicker').datetimepicker({
                    language: "{{ Lang::get('common.lang')}}",
                    pickTime: false
                });
                $.ajaxSetup({
                    headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')}
                });

                var $searchInput = $('#hladanie'),
                        $form = $('#search-form');

                $searchInput.autocomplete({
                    delay: 250,
                    source: function (request, add) {
                        var url = $TAGS_URL;
                        jQuery.getJSON(url, {query: request.term}, function (data) {
                            add(data.result);
                        });
                    },
                    select: function (event, ui) {
                        $searchInput.val(ui.item.label);
                        $form.submit();
                    },
                });

                @yield('ready_js')
            });
        </script>
    </head>
    <body>
        <div class="container-fluid" style="background-color: #AFCFFF; padding: 0;">
            <div class="row" style="margin: 0;">
                <div class="col-md-12" style="padding: 0">
                    <a class="hidden-xs" href="{{ action('HomeController@showWelcome') }}">{{ HTML::extendedImage('img/logo_geogebramag.png', '', array('style' => 'margin-top: 20px; margin-bottom: 20px')) }}</a>
                    <a id="hlavicka" class="visible-xs text-center" href="{{ action('HomeController@showWelcome') }}"><h1 style="color: white">Online Geogebra magazín Univerzity Komenského</h1></a>
                    <a class="hidden-xs hidden-sm" href="http://www.fmph.uniba.sk/">{{ HTML::extendedImage('img/FMFIUK_LIN.png', '', array('style' => 'vertical-align: bottom; margin-bottom: 50px; width: 80px; margin-left: 80px')) }}</a>
                    <a class="hidden-xs hidden-sm" href="https://uniba.sk/">{{ HTML::extendedImage('img/SYMBOL_2UK_LINKA.png', '', array('style' => 'vertical-align: bottom; margin-bottom: 50px; width: 80px')) }}</a>
                    <a class="hidden-xs hidden-sm" href="http://geogebra.org/">{{ HTML::extendedImage('img/geogebra.png', '', array('style' => 'vertical-align: bottom; margin-bottom: 50px; width: 130px')) }}</a>
                </div>
            </div>
            <nav class="navbar">
                <ul class="nav nav-tabs clearfix" style="border-bottom: none;">
                    <li><a href="{{{ action('HomeController@showWelcome') }}}" style="padding-bottom: 10px;"><span class="glyphicon glyphicon-home"></span></a></li>
                    <li>{{ HTML::linkAction('MenuController@getOnas', Lang::get('menu.about_us')) }}</li>
                    <li>{{ HTML::linkAction('MenuController@getKontakt', Lang::get('menu.contact')) }}</li>
                    @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Lang::get('menu.profil') }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>{{ HTML::linkAction('ArticleController@newArticle', Lang::get('article.new_article')) }}</li>
                            <li class="divider"></li>
                            <li>{{ HTML::linkAction('MenuController@getProfile', Lang::get('menu.edit_profile'), [Auth::id()]) }}</li>
                        </ul>
                    </li>
                    @if(Auth::user()->hasRank(User::ADMIN) || Auth::user()->hasRank(User::REDACTION))
                    <li>
                        {{ HTML::linkAction('UserController@getManagement', Lang::get('menu.user_management')) }}
                    </li>
                    @endif
                    <li>
                        {{ HTML::linkAction('LoginController@getLogout', Lang::get('menu.logout')) }}
                    </li>
                    @else
                    <li>
                        {{ HTML::linkAction('RegistrationController@getRegister', Lang::get('menu.registration')) }}
                    </li>
                    <li>
                        {{ HTML::linkAction('LoginController@getLogin', Lang::get('menu.login')) }}
                    </li>
                    @endif
                    <li class="pull-right" style="margin-right: 15px">
                        {{ Form::open(array(
                            'action' => 'HomeController@search',
                            'method' => 'get',
                            'class' => 'navbar-form navbar-right',
                            'role' => 'search',
                            'id' => 'search-form',
                        )) }}
                        <span id="tooltip" class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="Zadajte meno autora/názov článku/kľúčové slovo, vyberte si z ponúknutých možností a stlačte enter"></span>
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker">
                                {{ Form::text( 'hladanie', isset($query) ? $query : "", array(
                                    'id' => 'hladanie',
                                    'class' => 'form-control',
                                    'placeholder' => Lang::get('menu.search'),
                                    'maxlength' => 30
                                ) ) }}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </li>
                </ul>
            </nav>
        </div>
        <div class="container-fluid" style="margin-top: 15px">
            @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
            @endif
            @if(Session::has('warning'))
            <div class="alert alert-warning" role="alert">{{Session::get('warning')}}</div>
            @endif
            @if(Session::has('message'))
            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
            @endif
            @yield('content')
        </div>
        @yield('footer')
    </body>
</html>
