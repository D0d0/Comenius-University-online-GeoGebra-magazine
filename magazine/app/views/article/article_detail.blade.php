@extends('layouts.six_three_layout')

@section('js')
{{HTML::style('css/font-awesome.min.css')}}
{{HTML::style('css/summernote.css')}}
{{HTML::script('js/summernote.min.js')}}
@stop

@section('style')
[type=clanok]{
padding: 9px;
}

.img-rounded{
margin-bottom: 9px !important;
}
@stop

@section('ready_js')
@if($article->review && $article->state == Article::SENT && $article->review->reviewer->id == Auth::id())
    var accepted = {{ Article::ACCEPTED }};
    var unapproved = {{ Article::UNAPROVED }};
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['misc', ['undo', 'redo', 'help']]
        ],
    }).code('');
    
    var toggle_buttons = function(){
        if($('#ok').is(':disabled')){
            $('#ok').removeAttr('disabled');
            $('#nok').removeAttr('disabled');
        }else{
           $('#ok').attr('disabled', 'disabled');
           $('#nok').attr('disabled', 'disabled');
        }
    }
    var toggleScreen = function(){
        if($('.note-toolbar button').is(':disabled')){
            $('.note-editable').attr('contenteditable', true);
            $('.note-toolbar button').removeAttr('disabled');
            $('#title').removeAttr('disabled');
            $('.bootstrap-tagsinput [type=text]').removeAttr('disabled');
            $('#abstract').removeAttr('disabled');
        }else{
            $('.note-editable').attr('contenteditable', false);
            $('.note-toolbar button').attr('disabled', 'disabled');
            $('#title').attr('disabled', 'disabled');
            $('.bootstrap-tagsinput [type=text]').attr('disabled', 'disabled');
            $('#abstract').attr('disabled', 'disabled');
        }
    }
    
    var request = function(value){
        if(!$('.summernote').code()){
            return;
        }
        toggle_buttons();
        toggleScreen();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ action('ReviewController@postAddReview') }}',
            data: {
                'state' : value,
                'text' : $('.summernote').code(),
                'id' : $('#article_id').val(),
            },
            success: function(answer){
                if(answer['result']){
                    $('#recommend').html('{{ Lang::get('article.saved') }}');
                }else{
                    toggle_buttons();
                    $('#recommend').html('{{ Lang::get('article.error_saving') }}');
                }
            },
            error: function(){
                toggle_buttons();
                toggleScreen();
                $('#recommend').html('{{ Lang::get('article.error_saving') }}');
            }
        });
    }
    
    $('#ok').on('click', function(e){
        request(accepted);
    });
    
    $('#nok').on('click', function(e){
        request(unapproved);
    });
@endif
@stop

@section('left')
<div class="row">
    <div class="col-md-12">
        <div class="thumbnail clearfix row" type="clanok">
            <h1>{{{ $article->title }}}</h1>
            <p class="text-muted">
                <span class="glyphicon glyphicon-calendar"></span> {{ $article->getFormattedUdatedAt() }}
            </p>
            <p class="text-muted">
                {{ HTML::tags($article->id) }}
            </p>
            <p><em>{{{ $article->abstract }}}</em></p>
            <p>{{ $article->text }}</p>
        </div>
        @if($article->review && $article->state == Article::SENT && $article->review->reviewer->id == Auth::id())
        <div class="row" style="margin-bottom: 10px">
            <div class="summernote">

            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-6 col-md-3 text-right">
                <strong id="recommend">{{ Lang::get('article.y_recommendation') }}</strong>
                <button type="button" class="btn btn-default btn-md" id="ok">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> {{ Lang::get('article.publish') }}
                </button>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-default btn-md" id="nok">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> {{ Lang::get('article.not_publish') }}
                </button>
            </div>
            <input type="hidden" id="article_id" value="{{ $article->id }}">
        </div>
        @endif
        @if(($article->review && $article->review->text != '') && ($article->state != Article::SENT && $article->review->reviewer->id == Auth::id()) || ($article->state == Article::PUBLISHED && $article->user->id == Auth::id()))
            <div class="thumbnail clearfix row" type="clanok">
                <h1>{{{ Lang::get('article.review') }}}</h1>
                <p>{{ $article->review->text }}</p>
            </div>
        @endif
    </div>
</div>
@stop

@section('right')
<div class="row">
    <div class="col-md-12">
        <div class="thumbnail clearfix" type="clanok">
            <h3>{{ link_to_action('MenuController@getProfile', $article->user->name  , [$article->user_id]) }}</h3>
            <h4>{{ Lang::get('article.other_articles') }}</h4>
            <p>
                @forelse($article->user->articles()->published()->where('id', '<>', $article->id)->get() as $oneArticle)
                    {{ link_to_action('ArticleController@detail', $oneArticle->title, [$oneArticle->id]) }}
                    <br>
                @empty
                    {{ Lang::get('article.not_common_articles') }}
                @endforelse
            <h4>{{ Lang::get('article.related_articles') }}</h4>
            <p>
                @forelse($articles as $oneArticle)
                    {{ link_to_action('ArticleController@detail', $oneArticle->title, [$oneArticle->id]) }}
                    <br>
                @empty
                    {{ Lang::get('article.not_common_articles') }}
                @endforelse
            </p>
        </div>
    </div>
</div>
@stop