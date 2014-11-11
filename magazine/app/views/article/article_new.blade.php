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

var changeButton = function(){
    $('#save').html('{{ Lang::get('article.save') }}');
    if($('#title').val() && $('#abstract').val() && $('#tagy').tagsinput('items').length && $('.summernote').code()){
        $('#save').removeAttr('disabled');
    }else{
        $('#save').attr('disabled', 'disabled');
    }
}

var saveArticle = function(){
    timer && clearTimeout(timer);
    if($('#title').val() && $('#abstract').val() && $('#tagy').tagsinput('items').length && $('.summernote').code()){
        $('#save').attr('disabled', 'disabled').html('{{ Lang::get('article.saving') }}');
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
                console.log(answer);
                if(answer['id']){
                    $('#id').val(answer['id']);
                }
                $('#save').removeAttr('disabled').html('{{ Lang::get('article.saved') }}');
            },
            error: function(){
                $('#save').removeAttr('disabled').html('{{ Lang::get('article.saved') }}');
            }
        });
    }
}

function startTimer(){
    timer && clearTimeout(timer);
    timer = setTimeout(saveArticle, 2000);
}

$('.summernote').summernote({
    height: 300,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['ul', 'ol', 'paragraph']],
    ],
    onChange: function(e){
        changeButton();
        startTimer();
    }
}).code('{{ $article->text or '' }}');

$('#tagy').on('itemAdded', function(event) {
    startTimer();
    changeButton();
});

$('#tagy').on('itemRemoved', function(event) {
    startTimer();
    changeButton();
});

$('#title, #abstract').on('input', function(){
    startTimer();
    changeButton();
});

$('#save').on('click', function(){
    saveArticle();
});

changeButton();
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
            <div class="summernote">

            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-1 col-md-offset-10">
            <button type="button" class="btn btn-default" id="save">{{ Lang::get('article.save') }}</button>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-default" id="trash">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </div>
    </div>
</form>
@stop
