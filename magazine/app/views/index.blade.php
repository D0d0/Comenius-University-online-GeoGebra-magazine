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
                    <li>{{ HTML::link('/kontakt', 'Kontakt')}}</li>
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
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">
                                <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                <h3>Thumbnail label</h3>
                                <p class="text-muted"><span class="glyphicon glyphicon-user"></span> Meno Priezvisko</p>
                                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014</p>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">
                                <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                <h3>Thumbnail label</h3>
                                <p class="text-muted"><span class="glyphicon glyphicon-user"></span> Meno Priezvisko</p>
                                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014</p>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">
                                <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                <h3>Thumbnail label</h3>
                                <p class="text-muted"><span class="glyphicon glyphicon-user"></span> Meno Priezvisko</p>
                                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014</p>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">
                                <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                <h3>Thumbnail label</h3>
                                <p class="text-muted"><span class="glyphicon glyphicon-user"></span> Meno Priezvisko</p>
                                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014</p>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">
                                <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                <h3>Thumbnail label</h3>
                                <p class="text-muted"><span class="glyphicon glyphicon-user"></span> Meno Priezvisko</p>
                                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014</p>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">
                                <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                <h3>Thumbnail label</h3>
                                <p class="text-muted"><span class="glyphicon glyphicon-user"></span> Meno Priezvisko</p>
                                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014</p>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">
                                <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                <h3>Thumbnail label</h3>
                                <p class="text-muted"><span class="glyphicon glyphicon-user"></span> Meno Priezvisko</p>
                                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014</p>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">
                                <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                <h3>Thumbnail label</h3>
                                <p class="text-muted"><span class="glyphicon glyphicon-user"></span> Meno Priezvisko</p>
                                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014</p>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="thumbnail clearfix">
                                <img src="img/apache_pb.png" alt="..." class="img-thumbnail pull-left">
                                <h3>Thumbnail label</h3>
                                <p class="text-muted"><span class="glyphicon glyphicon-user"></span> Meno Priezvisko</p>
                                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014</p>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
