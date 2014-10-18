<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laravel PHP Framework</title>
        {{HTML::style('css/bootstrap.min.css')}}
        {{HTML::script('js/jquery.min.js')}}
        {{HTML::script('js/bootstrap.min.js')}}
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
                    $(".navbar").addClass("navbar-fixed-top");
                } else {
                    $('body').css({'padding-top': 0});
                    $('#menu').show();
                    $(".navbar").removeClass("navbar-fixed-top");
                }
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
                <ul class="nav nav-tabs" style="border-bottom: none;">
                    <li>{{ HTML::link('/onas', 'O nás')}}</li>
                    <li><a href="#">Kontakt</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Profil <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Článok</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Upraviť profil</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Registrácia</a></li>
                    <li class="pull-right">
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Hľadaj" id="hladanie">
                            </div>
                            <span id="extended_search"><a><span class="glyphicon glyphicon-plus"></span>Rozšírené vyhľadávanie</a></span>
                        </form>
                    </li>
                </ul>
            </nav>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="thumbnail clearfix">
                                        <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                        <h3>Meno priezvisko</h3>
                                        <p><span class="glyphicon glyphicon-envelope"></span> jozef.d13@gmail.com</p>
                                        <p><span class="glyphicon glyphicon-map-marker"></span> FMFI UK, Bratislava</p>    
                                        <p class="text-justify"><span class="glyphicon glyphicon-search"></span> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="thumbnail clearfix">
                                        <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                        <h3>Meno priezvisko</h3>
                                        <p><span class="glyphicon glyphicon-envelope"></span> jozef.d13@gmail.com</p>
                                        <p><span class="glyphicon glyphicon-map-marker"></span> FMFI UK, Bratislava</p>    
                                        <p class="text-justify"><span class="glyphicon glyphicon-search"></span> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- sem loadovat uzivatelov-->
                </div>
                <div class="col-md-4">
                    <div class="jumbotron">
                        <h2>Online geogebra časopis</h2>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
