<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laravel PHP Framework</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{HTML::style('css/bootstrap.min.css')}}
        {{HTML::script('js/jquery.min.js')}}
        {{HTML::script('js/bootstrap.min.js')}}
        @yield('js')
        <style>
            #menu{
                text-align: center;
            }

            .navbar{
                background-color: white;
            }

            img{
                margin-right: 4px !important;
            }

            h3{
                margin-top: 0;
            }
        </style>
        <script>
            $(window).scroll(function () {
                $('#hladanie').val(($(window).scrollTop() + $(window).height() >= $(document).height() - 100) ? 'spodok' : 'vrch');
                if ($(window).scrollTop() >= $("#menu").height()) {
                    $('body').css({'padding-top': ($('#menu').outerHeight(true) + $('.navbar').outerHeight(true))});
                    $('#menu').hide();
                    $('.navbar').addClass('navbar-fixed-top');
                } else {
                    $('body').css({'padding-top': 0});
                    $('#menu').show();
                    $('.navbar').removeClass('navbar-fixed-top');
                }
            });

            $(document).ready(function () {
                @yield('ready_js')
            });
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row" id="menu">
                <div class="col-md-12">
                    <h1>{{ HTML::link('/', 'Prvý online Geogebra časopis Univerzity Komenského')}}</h1>
                </div>
            </div>
            <nav class="navbar">
                <ul class="nav nav-tabs clearfix" style="border-bottom: none;">
                    <li>{{ HTML::link('/onas', Lang::get('menu.about_us'))}}</li>
                    <li>{{ HTML::link('/kontakt', Lang::get('menu.contact'))}}</li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Lang::get('menu.profil') }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>{{ HTML::link('/article/new', Lang::get('menu.article'))}}</li>
                            <li class="divider"></li>
                            <li><a href="#">{{ Lang::get('menu.edit_profile') }}</a></li>
                        </ul>
                    </li>
                    <li><a href="#">{{ Lang::get('menu.registration') }}</a></li>
                    <li class="pull-right">
                        {{ Form::open(array('url' => '/', 'class'=>'navbar-form navbar-right', 'role'=>'search')) }}
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ Lang::get('menu.search') }}" id="hladanie" name="hladanie">
                        </div>
                        <span id="extended_search">
                            <a><span class="glyphicon glyphicon-plus"></span>{{ Lang::get('menu.extended_search') }}</a>
                        </span>
                        {{ Form::close() }}
                    </li>
                </ul>
            </nav>
            @yield('content')
        </div>
    </body>
</html>
