@extends('layouts.two_one_layout')

@section('js')
{{HTML::extendedStyle('css/font-awesome.min.css')}}
@stop

@section('style')
[type=clanok]{
padding: 9px;
}
@stop

@section('left')
@if(count($redaction) > 0)
<h1>Redakčná rada</h1>
{{HTML::profileGrid($redaction, 2, 6)}}
@endif
@if(count($reviewers) > 0)
<h1>Recenzenti</h1>
{{HTML::profileGrid($reviewers, 2, 6)}}
@endif
@if(count($admin) > 0)
<h1>Administrátori</h1>
{{HTML::profileGrid($admin, 2, 6)}}
@endif
@stop

@section('right')
<div class="jumbotron">
    <h2>Geogebra magazín Univerzity Komenského</h2>
    <p class="text-justify">{{ File::get('onas.txt') }}</p>
</div>
@stop