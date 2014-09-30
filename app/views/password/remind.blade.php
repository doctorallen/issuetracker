@extends('layouts.master')
@section('title', 'Forgot Password');
@section('content')
<h1>Forgot Password</h1>
<form action="{{ action('RemindersController@postRemind') }}" method="POST" class="form-horizontal">
@if(Session::has('flash_error'))
<div class="session-flash error">{{ Session::get('flash_error')}}</div>
@endif
	<div class="form-group">
		{{Form::label('email', 'Email', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::email('email')}}
			{{ $errors->first('email', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="actions">
		{{Form::submit('Send Reminder', array('class' => 'btn btn-primary btn-lg')) }}
	</div>	
</form>
@stop {{-- end of content section --}}
@section('footer')
