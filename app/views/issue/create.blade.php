@extends('layouts.master')
@section('title', 'Report New Issue');
@section('content')
<h1>Report New Issue</h1>
{{ Form::open(array('route' => 'issue.store', 'class' => 'form-horizontal issue-create', 'files' => true)) }}
@if(Auth::user()->isAdmin())
<div class="form-group">
	{{Form::label('project_id', 'Project', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::select('project_id', (array('' => '-Select-') + $projects->lists('name', 'id')), Input::get('project_id')) }}
		{{ $errors->first('project_id', '<span class="error">:message</span>') }}
	</div>
</div>	
@else
<input type="hidden" name="project_id" value="{{Auth::user()->project_id}}">
@endif
<div class="form-group">
	{{Form::label('email', 'Your Email', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::text('email', Auth::user()->email)}}
		{{ $errors->first('email', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	{{Form::label('type', 'Type of Issue', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::select('type', array('' => '-Select-', 'bug'=>'Something is wrong', 'change' => 'I want this to work/look differently'))}}
		{{ $errors->first('type', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
		{{Form::label('url', 'Web Address of problematic page', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::text('url')}}
		{{ $errors->first('url', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="col-sm-5 control-label">
		{{Form::label('actual', 'Detailed explanation of the issue') }}
		<div class="explanation">Please provide a detailed explanation of how this feature/component is currently performing</div>
		{{ $errors->first('actual', '<span class="error block-error">:message</span>') }}
	</div>
	<div class="col-sm-7">
		{{Form::textarea('actual')}}
	</div>
</div>	
<div class="form-group">
	<div class="col-sm-5 control-label">
		{{Form::label('expectation', 'Detailed explanation of how you expected this feature to work') }}
		<div class="explanation">Please provide a detailed explanation of how you expected this feature/component to perform</div>
		{{ $errors->first('expectation', '<span class="error block-error">:message</span>') }}
	</div>
	<div class="col-sm-7">
		{{Form::textarea('expectation')}}
	</div>
</div>	
<div class="form-group">
	<div class="col-sm-5 control-label">
		{{Form::label('steps', 'List steps to recreate the issue') }}
		<div class="explanation">Please provide a step-by-step explanation of how you encountered this issue</div>
		{{ $errors->first('steps', '<span class="error block-error">:message</span>') }}
	</div>
	<div class="col-sm-7">
		{{Form::textarea('steps')}}
	</div>
</div>	
<div class="form-group">
		{{Form::label('screenshot', 'Upload a screenshot', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::file('screenshot')}}
	</div>
</div>	
<div class="actions">
	{{Form::submit('CREATE', array('class' => 'btn btn-success btn-lg')) }}
</div>	
{{ Form::close() }}
@stop {{-- end of content section --}}
@section('footer')
{{ HTML::script('js/agent.js') }}
@stop
