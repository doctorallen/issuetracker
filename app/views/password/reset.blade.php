@extends('layouts.master')
@section('title', 'Reset Password');
@section('content')
<h1>Reset Password</h1>
<form action="{{ action('RemindersController@postReset') }}" method="POST" class="form-horizontal">
@if(Session::has('flash_error'))
<div class="session-flash error">{{ Session::get('flash_error')}}</div>
@endif
    <input type="hidden" name="token" value="{{ $token }}">
	<div class="form-group">
		{{Form::label('email', 'Email', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::email('email')}}
			{{ $errors->first('email', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="form-group">
		{{Form::label('password', 'Password', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::password('password')}}
			{{ $errors->first('password', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="form-group">
		{{Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::password('password_confirmation')}}
			{{ $errors->first('password_confirmation', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="actions">
		{{Form::submit('Reset Password', array('class' => 'btn btn-primary btn-lg')) }}
	</div>	
</form>
@stop {{-- end of content section --}}
@section('footer')
