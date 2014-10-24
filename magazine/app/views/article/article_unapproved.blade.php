@extends('article.article')

@section('left')
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="thumbnail clearfix">
                    <img src="{{URL::asset('img/apache_pb.png')}}" alt="..." class="img-rounded pull-left">
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
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="thumbnail clearfix">
                    <img src="{{URL::asset('img/apache_pb.png')}}" alt="..." class="img-rounded pull-left">
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
@stop