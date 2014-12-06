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
@if(!$articles->isEmpty())
{{HTML::articleGrid($articles, 2, 6, false)}}
@else
<div class="row">
    <div class="jumbotron">
        TODO
        Ziadny clanok na zobrazenie
    </div>
</div>
@endif
@stop