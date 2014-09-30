@extends('layouts.master')
@section('title')Editing Issue #{{$issue->id}}@stop
@section('content')
<h1>Edit Issue #{{$issue->id}}</h1>
{{ Form::model($issue, array('route' => array('issue.update', $issue->id), 'method' => 'PUT', 'files' => true, 'class' => 'form-horizontal issue-edit')) }}
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
	@if($issue->screenshot)
	<div class="form-group">
		<label class="col-sm-5 control-label">Current Screenshot</label>
		<div class="col-sm-7">
			<a target="_blank" href="/images/{{$issue->screenshot}}">{{ HTML::image('images/' . $issue->screenshot, 'Screenshot',array('max-width' => 600))}}</a>
		</div>
	</div>
	@endif
	<div class="form-group">
		{{Form::label('status', 'Status', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::select('status', array('Open' => 'Open', 'In-Progress' => 'In-Progress', 'Blocked' => 'Blocked', 'Completed' => 'Completed', 'Closed' => 'Closed'))}}
			{{ $errors->first('status', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="form-group">
		{{Form::label('priority', 'Priority', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::select('priority', array('Low' => 'Low', 'Medium' => 'Medium', 'High' => 'High'))}}
			{{ $errors->first('priority', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="actions">
		{{Form::submit('SUBMIT', array('class' => 'btn btn-success btn-lg')) }}
	</div>	
{{ Form::close() }}
@stop {{-- end of content section --}}
