@extends('layouts.master')
@section('title', 'Create New Project');
@section('content')
<h1>Create New Project</h1>
{{ Form::open(array('route' => array('project.store'), 'class' => 'form-horizontal project-create')) }}
<div class="form-group">
		{{Form::label('name', 'Name', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::text('name')}}
		{{ $errors->first('name', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('slug', 'URL Slug', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		{{Form::text('slug')}}
		{{ $errors->first('slug', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="actions">
	{{form::submit('CREATE', array('class' => 'btn btn-success btn-lg')) }}
</div>	
{{ Form::close() }}
@stop {{-- end of content section --}}
