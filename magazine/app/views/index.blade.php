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
<?php $i = 0 ?>
@foreach($articles as $article)
@if($i % 3 == 0)
<div class="row container-md-height">
    @endif
    {{HTML::article($article->id)}}
    @if($i % 3 == 2)
</div>
@endif
<?php $i++ ?>
@endforeach
{{ $articles->links() }}
@stop