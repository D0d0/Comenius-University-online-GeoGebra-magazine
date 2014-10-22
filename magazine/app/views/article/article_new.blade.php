@extends('article.article')

@section('js')
{{HTML::style('css/font-awesome.min.css')}}
{{HTML::style('css/summernote.css')}}
{{HTML::script('js/summernote.min.js')}}
{{HTML::script('js/bootstrap-tagsinput.min.js')}}
{{HTML::style('css/bootstrap-tagsinput.css')}}
@stop

@section('ready_js')
$('.summernote').summernote({
    height: 300,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],],
    onChange: function(contents) {
        console.log(contents);
    }
});
@stop

@section('left')
<form class="form-horizontal clearfix" role="form">
    <div class="form-group">
        <label for="nadpis" class="col-md-1 control-label">{{ Lang::get('article.caption') }}</label>
        <div class="col-md-11">
            <input type="text" id="nadpis" class="form-control">
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
            <input type="text" id="abstrakt" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-1 control-label">{{ Lang::get('article.text') }}</label>
        <div class="col-md-11">
            <div class="summernote">

            </div>
        </div>
    </div>
</form>
@stop
