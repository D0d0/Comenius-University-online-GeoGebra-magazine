@extends('article.article')

@section('js')
{{HTML::style('css/font-awesome.min.css')}}
{{HTML::style('css/summernote.css')}}
{{HTML::script('js/summernote.min.js')}}
{{HTML::script('js/bootstrap-tagsinput.min.js')}}
{{HTML::style('css/bootstrap-tagsinput.css')}}
@stop

@section('ready_js')
var timer;

var saveArticle = function(){
    timer && clearTimeout(timer);
    /*console.log($('#title').val());
    console.log($('#abstract').val());    
    console.log($('#tagy').tagsinput('items'));
    console.log($('.summernote').code());*/
    if($('#title').val() && $('#abstract').val() && $('#tagy').tagsinput('items') && $('.summernote').code()){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ action('ArticleController@postNewArticle') }}',
            data: {
                    'title' : $('#title').val(),
                    'abstract' : $('#abstract').val(),
                    'tagy' : $('#tagy').tagsinput('items'),
                    'text' : $('.summernote').code(),
                    'id' : $('#id').val(),
                },
            success: function(answer){
                console.log(answer['id']);
                if(answer['id']){
                    $('#id').val(answer['id']);
                }
            },
            error: function(){
                console.log('erroris');
            }
        });
    }
}

function startTimer(){
    timer && clearTimeout(timer);
    timer = setTimeout(saveArticle, 3000);
}

$('.summernote').summernote({
    height: 300,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],],
    onChange: function(e){
            startTimer();
        }
}).code('{{ $article->text or '' }}');

$('#tagy').on('itemAdded', function(event) {
    startTimer();
});

$('#tagy').on('itemRemoved', function(event) {
    startTimer();
});

$('#title, #abstract').on('input', function(){
    startTimer();
});
@stop

@section('left')
<form class="form-horizontal clearfix" role="form">
    {{ Form::hidden('id', isset($article) && isset($article->id) ? $article->id : '', array('id' => 'id'))}}
    <div class="form-group">
        <label for="nadpis" class="col-md-1 control-label">{{ Lang::get('article.caption') }}</label>
        <div class="col-md-11">
            <input type="text" id="title" class="form-control" value="{{ $article->title or ''}}">
        </div>
    </div>
    <div class="form-group">
        <label for="tagy" class="col-md-1 control-label">{{ Lang::get('article.key_words') }}</label>
        <div class="col-md-11">
            <input type="text" id="tagy" class="form-control" data-role="tagsinput">
        </div>
    </div>
    <div class="form-group">
        <label for="abstrakt" class="col-md-1 control-label">{{ Lang::get('article.abstract') }}</label>
        <div class="col-md-11">
            <input type="text" id="abstract" class="form-control" value="{{ $article->abstract or '' }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-1 control-label">{{ Lang::get('article.text') }}</label>
        <div class="col-md-11">
            <div class="summernote thumbnail">

            </div>
        </div>
    </div>
</form>
@stop
