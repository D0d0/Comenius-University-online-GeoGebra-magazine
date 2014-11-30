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
    var was_published = '{{ Lang::get('article.was_published') }}';
    var was_not_published = '{{ Lang::get('article.was_not_published') }}';
    
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
                    $('#' + id + ' .form-group:nth-child(2)').empty().append('<p class="text-center"><big><strong>'+ (state == draft ? was_not_published : was_published) + '</strong></big></p>');
                }
            },
            error: function(){
                
            }
        });
    }
    var addReviewer = function(reviewer_id, id, reviewer_name){
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
                    $('#' + id + ' .form-group').empty().append('<div class="col-md-4 col-md-offset-2 text-right"><strong>{{Lang::get('article.reviewer_name')}}</strong></div><div class="col-md-6"><strong>' + reviewer_name + '</strong></div>');
                }
            },
            error: function(){
            
            }
        });
    }

    $('.save_reviewer').on('click', function(){
        var id = getArticleID(this);
        var reviewer_id = $(this).closest('form').find('.reviewer_id').val();
        var reviewer_name = $(this).closest('form').find('.reviewer_id :selected').text();
        console.log(reviewer_name);
        addReviewer(reviewer_id, id, reviewer_name);
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