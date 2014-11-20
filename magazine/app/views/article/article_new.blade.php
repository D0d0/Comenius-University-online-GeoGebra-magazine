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
var saving = false;

var changeButton = function(){
    if (saving){
        return;
    }
    $('#save').html('{{ Lang::get('article.save') }}');
    if($('#title').val() && $('#abstract').val() && $('#tagy').tagsinput('items').length && $('.summernote').code()){
        $('#save').removeAttr('disabled');
    }else{
        $('#save').attr('disabled', 'disabled');
    }
}

var saveArticle = function(){
    if(saving){
        return;
    }
    saving = true;
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
                saving = false;
                if(answer['id']){
                    $('#id').val(answer['id']);
                }
                $('#save').removeAttr('disabled').html('{{ Lang::get('article.saved') }}');
            },
            error: function(){
                saving = false;
                $('#save').removeAttr('disabled').html('{{ Lang::get('article.error_saving') }}');
            }
        });
    }
}

function startTimer(){
    timer && clearTimeout(timer);
    timer = setTimeout(saveArticle, 2000);
}

$.summernote.plugins = {
    "chart" : {
        label : 'chart',
        //dropd
        event : function(e, editor, layout) {
            var $editable = layout.editable();
            $editable.trigger('focus');
            var dom = $('<div class="embed-responsive embed-responsive-16by9"><iframe id="frame" class="embed-responsive-item" src="http://www.geogebratube.org/material/iframe/id/23587/width/500/height/300/border/888888/rc/false/ai/false/sdz/true/smb/false/stb/false/stbh/true/ld/false/sri/false/at/preferhtml5"></iframe></div>')[0];
            editor.insertDom($editable, dom);
        }
    }
}

$('.summernote').summernote({
    height: 300,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'video']],
        ['misc', ['undo', 'redo', 'help']],
        ['chart', ['chart']]
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

$('#trash').on('click', function(){
    if(!saving && $('#id').val() != ''){
        saving = true;
        $('#save').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ action('ArticleController@postDeteleArticle') }}',
            data: {
                'id' : $('#id').val(),
            },
            success: function(answer){
                if(answer['result']){
                    saving = false;
                    $('#title').val(''),
                    $('#abstract').val(''),
                    $('#tagy').tagsinput('removeAll');
                    $('.summernote').code(''),
                    $('#id').val('');
                    $('#save').removeAttr('disabled');
                }
            },
            error: function(){
                saving = false;
                $('#save').removeAttr('disabled');
            }
        });
    }
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
            <input type="text" id="tagy" class="form-control" data-role="tagsinput" value="{{{ $tags or ''}}}">
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
        <div class="col-md-1 col-md-offset-9">
            <button type="button" class="btn btn-default" id="save">{{ Lang::get('article.save') }}</button>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-default" id="send">{{ Lang::get('article.send') }}</button>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-default" id="trash">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </div>
    </div>
</form>
@stop
