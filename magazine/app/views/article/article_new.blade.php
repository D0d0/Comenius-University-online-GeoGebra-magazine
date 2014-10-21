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
height: 300
});
@stop

@section('left')
<form class="form-horizontal clearfix" role="form">
    <div class="form-group">
        <label for="nadpis" class="col-md-2 control-label">Nadpis</label>
        <div class="col-md-10">
            <input type="text" id="nadpis" class="form-control" data-role="tagsinput">
        </div>
    </div>
</form>
<div class="summernote">

</div>
@stop
