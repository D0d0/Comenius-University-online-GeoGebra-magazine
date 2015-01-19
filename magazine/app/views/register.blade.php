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
        <div class="form-group {{ $errors->has('name') ? "has-error" : "" }}">
            <div class="col-md-3">
                {{ Form::label('name', Lang::get('common.name')) }}
            </div>
            <div class="col-md-9">
                {{Form::text('name', '',array('class'=>'form-control', 'placeholder' => Lang::get('common.enter_name')))}}
                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('email') ? "has-error" : "" }}">
            <div class="col-md-3">
                {{ Form::label('email', Lang::get('common.email')) }}
            </div>
            <div class="col-md-9">
                {{Form::email('email', '',array('class'=>'form-control', 'placeholder' => Lang::get('common.enter_email')))}}
                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? "has-error" : "" }}">
            <div class="col-md-3">
                {{ Form::label('password', Lang::get('common.password')) }}
            </div>
            <div class="col-md-9">
                {{ Form::password('password', array('class'=>'form-control', 'placeholder' => Lang::get('common.enter_password'))) }}
                @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('password_confirmation') ? "has-error" : "" }}">
            <div class="col-md-3">
                {{ Form::label('password_confirmation', Lang::get('common.confirm_password')) }}
            </div>
            <div class="col-md-9">
                {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder' => Lang::get('common.again_password'))) }}
                @if ($errors->has('password_confirmation')) <p class="help-block" style="margin-bottom: 0px;">{{ $errors->first('password_confirmation') }}</p> @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('school') ? "has-error" : "" }}">
            <div class="col-md-3">
                {{ Form::label('school', Lang::get('common.school')) }}
            </div>
            <div class="col-md-9">
                {{ Form::text('school', '', array('class'=>'form-control', 'placeholder' => Lang::get('common.school'))) }}
                @if ($errors->has('school')) <p class="help-block" style="margin-bottom: 0px;">{{ $errors->first('school') }}</p> @endif
            </div>
        </div>
        {{Form::submit(Lang::get('common.send'), array('class'=>'btn btn-default'))}}
    </div>
    {{ Form::close() }}
</div>
@stop