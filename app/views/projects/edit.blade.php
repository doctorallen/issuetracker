@extends('layouts.master')
@section('title')Editing {{$project->name}}@stop
@section('content')
<h1>Edit {{$project->name}} Project</h1>
{{ Form::model($project, array('route' => array('project.update', $project->id), 'method' => 'PUT', 'class' => 'form-horizontal project-edit')) }}
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
	{{form::submit('SUBMIT', array('class' => 'btn btn-success btn-lg')) }}
</div>	
{{ Form::close() }}
@stop {{-- end of content section --}}
