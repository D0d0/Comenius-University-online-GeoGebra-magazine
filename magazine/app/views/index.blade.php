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
<div class="onepage">
{{ HTML::articleGrid($articles, 3) }}
{{ $articles->links() }}
</div>
@stop