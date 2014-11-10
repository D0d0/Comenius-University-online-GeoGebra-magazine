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
    @forelse($articles as $article)
    {{HTML::article($article->id,6)}}
    @empty
    <div class="jumbotron">
        TODO
        Ziadny clanok na zobrazenie
    </div>
    @endforelse
</div>
@stop