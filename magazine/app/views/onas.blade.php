@extends('layouts.two_one_layout')

@section('left')
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="thumbnail clearfix">
                    <img src="{{URL::asset('img/apache_pb.png')}}" alt="..." class="img-thumbnail pull-left">
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
                    <img src="{{URL::asset('img/apache_pb.png')}}" alt="..." class="img-thumbnail pull-left">
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
@stop

@section('right')
<div class="jumbotron">
    <h2>Online geogebra časopis</h2>
    <p class="text-justify">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit</p>
</div>
@stop