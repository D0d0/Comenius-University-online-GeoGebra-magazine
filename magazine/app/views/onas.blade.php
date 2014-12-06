@extends('layouts.two_one_layout')

@section('js')
{{HTML::style('css/font-awesome.min.css')}}
@stop

@section('style')
[type=clanok]{
padding: 9px;
}
@stop

@section('left')
@if(count($admin) > 0)
<h1>Administrátori</h1>
{{HTML::profileGrid($admin, 2, 6)}}
@endif
@if(count($redaction) > 0)
<h1>Redakčná rada</h1>
{{HTML::profileGrid($redaction, 2, 6)}}
@endif
@if(count($reviewers) > 0)
<h1>Recenzenti</h1>
{{HTML::profileGrid($reviewers, 2, 6)}}
@endif
@stop

@section('right')
<div class="jumbotron">
    <h2>Online geogebra časopis</h2>
    <p class="text-justify">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit</p>
</div>
@stop