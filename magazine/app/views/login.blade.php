@extends('layouts.center_content')

@section('style')
[type=clanok]{
padding: 9px;
}
@stop

@section('center')
<div class="col-md-6 col-md-offset-3">
    {{ Form::open(array('action' => 'LoginController@postLogin', 'class' => 'form-horizontal', 'method' => 'post', 'role' => 'form')) }}
    <div class="form-group thumbnail" type="clanok">
        <div class="form-group">
            <div class="col-md-3">
                {{ Form::label('email', Lang::get('common.email')) }}
            </div>
            <div class="col-md-9">
                {{Form::email('email', '',array('class'=>'form-control', 'placeholder' => Lang::get('common.enter_email')))}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{ Form::label('password', Lang::get('common.password')) }}
            </div>
            <div class="col-md-9">
                {{ Form::password('password', array('class'=>'form-control', 'placeholder' => Lang::get('common.enter_password'))) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('remember', Lang::get('common.remember_login'), array('class'=>'col-md-3')) }}
            <div class="col-md-3">
                {{ Form::checkbox('remember', 'true', array('class'=>'form-control')) }}
            </div>
            <div class="col-md-9 text-right">
                {{ HTML::linkAction('RemindersController@getRemind', Lang::get('reminders.lost_password')) }}
            </div>
        </div>
        <div class="form-group">
        </div>
        {{Form::submit(Lang::get('common.send'), array('class'=>'btn btn-default'))}}
    </div>
    {{ Form::close() }}
</div>
@stop