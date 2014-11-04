@extends('article.article')

@section('style')
[type=clanok]{
padding: 9px;
}

img{
margin-right: 9px !important;
}
@stop

@section('left')
<div class="row">
    <div class="col-md-6">
        <div class="thumbnail clearfix" type="clanok">
            {{ HTML::image('img/apache_pb.png', 'alt', array('class' => 'img-rounded pull-left')) }}
            <h3>Thumbnail label</h3>
            <p class="text-muted"><span class="glyphicon glyphicon-user"></span>&nbsp;Meno Priezvisko</p>
            <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Ut. 1. apríl 2014</p>
            <p class="text-muted">
                <span class="glyphicon glyphicon-tags"></span>
                &nbsp;<a class="label label-primary">kosinus</a>
                <a class="label label-primary">kosinus</a>
                <a class="label label-primary">kosinus</a>
                <a class="label label-primary">sinus</a>
                <a class="label label-primary">Tag3</a>
                <a class="label label-primary">Tag4</a>
                <a class="label label-primary">Pytagorova veta</a>
                <a class="label label-primary">Tag5</a>
            </p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="thumbnail clearfix" type="clanok">
            {{ HTML::image('img/apache_pb.png', 'alt', array('class' => 'img-rounded pull-left')) }}
            <h3>Thumbnail label</h3>
            <p class="text-muted"><span class="glyphicon glyphicon-user"></span>&nbsp;Meno Priezvisko</p>
            <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Ut. 1. apríl 2014</p>
            <p class="text-muted">
                <span class="glyphicon glyphicon-tags"></span>
                &nbsp;<a class="label label-primary">kosinus</a>
                <a class="label label-primary">kosinus</a>
                <a class="label label-primary">kosinus</a>
                <a class="label label-primary">sinus</a>
                <a class="label label-primary">Tag3</a>
                <a class="label label-primary">Tag4</a>
                <a class="label label-primary">Pytagorova veta</a>
                <a class="label label-primary">Tag5</a>
            </p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit </p>
        </div>
    </div>
</div>
@stop