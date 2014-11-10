@extends('layouts.master')

@section('style')
[type=clanok]{
padding: 9px;
}

img{
margin-right: 9px !important;
}
@stop

@section('content')
<div class="row">
    @for($i = 0; $i < $max; $i++)
    {{HTML::article(rand(1,100))}}
    {{HTML::article(rand(1,100))}}
    {{HTML::article(rand(1,100))}}
    @endfor
</div>
@stop