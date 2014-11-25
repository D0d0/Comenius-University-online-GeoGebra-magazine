@extends('article.article')

@section('style')
[type=clanok]{
padding: 9px;
}

img{
margin-right: 9px !important;
}
@stop

@section('ready_js')
    var draft = {{ Article::DRAFT }};
    var published = {{ Article::PUBLISHED }};
    
    var getArticleID = function(obj){
        return $(obj).closest('form').attr('id')
    }
    
    var changeState = function(state, id){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ action('ArticleController@changeState') }}',
            data: {
                'state' : state,
                'id' : id,
            },
            success: function(answer){
                if(answer['result']){
                    
                }
            },
            error: function(){
            
            }
        });
    }
    var addReviewer = function(reviewer_id, id){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ action('ReviewController@postCreateReview') }}',
            data: {
                'reviewer_id' : reviewer_id,
                'id' : id,
            },
            success: function(answer){
                if(answer['result']){
                    
                }
            },
            error: function(){
            
            }
        });
    }

    $('.save_reviewer').on('click', function(){
        var id = getArticleID(this);
        var reviewer_id = $(this).closest('form').find('.reviewer_id').val();
        addReviewer(reviewer_id, id);
    });
    
    $('.non_publish').on('click', function(){
        changeState(draft, getArticleID(this));
    });
    
    $('.publish').on('click', function(){
        changeState(published, getArticleID(this));
    });
@stop


@section('left')
@if(!$articles->isEmpty())
{{HTML::articleGrid($articles, 2, 6, false, true)}}
@else
<div class="row">
    <div class="jumbotron">
        TODO
        Ziadny clanok na zobrazenie
    </div>
</div>
@endif
@stop