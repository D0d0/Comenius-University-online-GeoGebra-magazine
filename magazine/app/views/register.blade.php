@extends('layouts.center_content')

@section('style')
[type=clanok]{
padding: 9px;
}
@stop

@section('center')
<div class="col-md-6 col-md-offset-3">
    {{ Form::open(array('action' => 'RegistrationController@postRegister', 'class' => 'form-horizontal', 'method' => 'post', 'role' => 'form')) }}
    <div class="form-group thumbnail" type="clanok">
        <div class="form-group">
            <div class="col-md-3">
                {{ Form::label('name', 'Meno') }}
            </div>
            <div class="col-md-9">
                {{Form::text('name', '',array('class'=>'form-control', 'placeholder' =>'Enter name'))}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{ Form::label('email', 'Email') }}
            </div>
            <div class="col-md-9">
                {{Form::email('email', '',array('class'=>'form-control', 'placeholder' =>'Enter mail'))}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{ Form::label('password', 'Password') }}
            </div>
            <div class="col-md-9">
                {{ Form::password('password', array('class'=>'form-control', 'placeholder' =>'Enter password')) }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{ Form::label('password_confirmation', 'Confirm password') }}
            </div>
            <div class="col-md-9">
                {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder' =>'Confirm password')) }}
            </div>
        </div>
        {{Form::submit('Submit',array('class'=>'btn btn-default'))}}
    </div>
    {{ Form::close() }}
</div>
@stop