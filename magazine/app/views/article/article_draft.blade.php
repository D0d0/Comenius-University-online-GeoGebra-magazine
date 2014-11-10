@extends('article.article')

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