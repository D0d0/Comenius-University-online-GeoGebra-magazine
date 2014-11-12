@extends('layouts.master')

@section('js')
{{HTML::script('js/jquery.infinitescroll.min.js')}}
@stop

@section('style')
[type=clanok]{
padding: 9px;
}

img{
margin-right: 9px !important;
}

.pagination{
    display: none;
}

#infscr-loading{
    display: none!important;
}
@stop

@section('ready_js')
$('.onepage').infinitescroll({
    navSelector: ".pagination",
    nextSelector: ".pagination a:last",
    itemSelector: ".onepage",
    dataType: 'html',
    maxPage: {{ $maxPages }} ,
    path: function(index) {
        //môžu sa použiť vlastné parametre, ak bude žiadané vo vyhľádávaní
        return "?page=" + index;
    }
});
if($(window).height() >= $(document).height()){
    $('.onepage').infinitescroll('retrieve');
};
@stop

@section('content')
<div class="onepage">
{{ HTML::articleGrid($articles, 3) }}
{{ $articles->links() }}
</div>
@stop