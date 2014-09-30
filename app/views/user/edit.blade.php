@extends('layouts.master')
@section('title')Editing  {{$user->username}}@stop
@section('content')
<h1>Edit User {{$user->username}}</h1>
{{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT', 'class' => 'form-horizontal user-edit')) }}
	<div class="form-group">
		{{Form::label('email', 'Email', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::text('email')}}
			{{ $errors->first('email', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="form-group">
		{{Form::label('username', 'Username', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::text('username')}}
			{{ $errors->first('username', '<span class="error">:message</span>') }}
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
		{{Form::label('project_id', 'Project', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::select('project_id', $projects->lists('name', 'id')) }}
			{{ $errors->first('project_id', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="form-group">
		{{Form::label('permission_level', 'User Level', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::select('permission_level', array(1 => 'Client', 0 => 'Admin')) }}
			{{ $errors->first('permission_level', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="actions">
		{{Form::submit('SUBMIT', array('class' => 'btn btn-success btn-lg')) }}
	</div>	
{{ Form::close() }}
@stop {{-- end of content section --}}
@section('footer')
{{ HTML::script('js/script.js') }}
@stop
