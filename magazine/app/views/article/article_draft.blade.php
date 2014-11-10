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
<?php $i = 0 ?>
@forelse($articles as $article)
@if($i % 2 == 0)
<div class="row container-md-height">
    @endif
    {{HTML::article($article->id, 6, true)}}
    @if($i % 2 == 1)
</div>
@endif
<?php $i++ ?>
@empty
<div class="row">
    <div class="jumbotron">
        TODO
        Ziadny clanok na zobrazenie
    </div>
</div>
@endforelse
@stop