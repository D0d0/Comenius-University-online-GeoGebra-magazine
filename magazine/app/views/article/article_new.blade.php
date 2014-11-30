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
var send = {{ Article::SENT }};

var changeButton = function(){
    if($('#id').val()){
        $('#send').removeAttr('disabled');
    }else{
        $('#send').attr('disabled', 'disabled');
    }
    if (saving){
        return false;
    }
    if($('#title').val() && $('#abstract').val() && $('#tagy').tagsinput('items').length && $('.summernote').code()){
        $('#save').removeAttr('disabled');
    }else{
        $('#save').attr('disabled', 'disabled');
    }
}

var saveArticle = function(){
    if(saving || !($('#title').val() && $('#abstract').val() && $('#tagy').tagsinput('items').length && $('.summernote').code())){
        return false;
    }
    saving = true;
    timer && clearTimeout(timer);
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
            changeButton();
        },
        error: function(){
            saving = false;
            $('#save').removeAttr('disabled').html('{{ Lang::get('article.error_saving') }}');
            changeButton();
        }
    });
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

function startTimer(){
    timer && clearTimeout(timer);
    timer = setTimeout(saveArticle, 2000);
}

var editorG;
var layoutG;
var $editableG;

var insertGeogebra = function(id){
    $editableG.trigger('focus');
    var dom = $('<div class="embed-responsive embed-responsive-16by9"><iframe id="frame" class="embed-responsive-item" src="http://www.geogebratube.org/material/iframe/id/' + id + '/width/500/height/300/border/888888/rc/false/ai/false/sdz/true/smb/false/stb/false/stbh/true/ld/false/sri/false/at/preferhtml5"></iframe></div>')[0];
    editorG.insertDom($editableG, dom);
}

$.summernote.plugins = {
    "Geogebra" : {
        label : 'Geogebra',
        event : function(e, editor, layout) {
            editorG = editor;
            layoutG = layout;
            $editableG = layout.editable();
            $('#geogebra_id').val('');
            $('#geogebraModal').modal('show');
        }
    }
}

$('.summernote').summernote({
    height: 300,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'video']],
        ['misc', ['undo', 'redo', 'help']],
        ['Geogebra', ['Geogebra']]
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

$('#send').on('click', function(){
    if(!$('#id').val()){
        return false;
    }
    toggleScreen();
    saving = true;
    timer && clearTimeout(timer);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '{{ action('ArticleController@changeState') }}',
        data: {
            'state' : send,
            'id' : $('#id').val(),
        },
        success: function(answer){
            if(answer['result']){
                $('#send').html('{{ Lang::get('article.saved') }}');
            }
        },
        error: function(){
            toggleScreen();
            $('#send').html('{{ Lang::get('article.error_saving') }}');
        }
    });
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

$('.close').on('click', function(){
    $('#geogebraModal').modal('hide');
});

$('#saveid').on('click', function(){
    if($('#geogebra_id').val()){
        $('#geogebraModal').modal('hide');
        insertGeogebra($('#geogebra_id').val());
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
<div class="modal fade" id="geogebraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">{{ Lang::get('common.close') }}</span></button>
                <h4 class="modal-title" id="exampleModalLabel">{{ Lang::get('article.geoegbra_id') }}</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{ Lang::get('article.geoegbra_id') }}:</label>
                        <input type="text" class="form-control" id="geogebra_id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" class="close">{{ Lang::get('common.close') }}</button>
                <button type="button" class="btn btn-primary" id="saveid">{{ Lang::get('common.insert') }}</button>
            </div>
        </div>
    </div>
</div>
@stop
