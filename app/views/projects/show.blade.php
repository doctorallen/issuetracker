@extends('layouts.master')
@section('title'){{$project->name}}@stop
@section('content')
<h1>Project - {{$project->name}}</h1>
<div class="row">
	<div class="col-sm-5 ">
		<label>Name:</label>
	</div>
	<div class="col-sm-7">
		{{$project->name}}
	</div>
</div>
<div class="row">
	<div class="col-sm-5 ">
		<label>URL Slug:</label>
	</div>
	<div class="col-sm-7">
		{{$project->slug}}
	</div>
</div>
<div class="clear"></div>
<div class="actions">
	{{HTML::linkRoute('project.edit',"EDIT", $project->id, array('class' => 'btn btn-primary btn-lg'))}}
	{{HTML::linkRoute('project.issues','View Issues', $project->slug, array('class' =>'btn btn-success btn-lg'))}}
	@if($project->userHasSubscription(Auth::user()->id))
			@include('subscriptions.unsubscribe', ['subscribable_id' => $project->id, 'subscribable_type' => 'Project'])
	@else
			@include('subscriptions.subscribe', ['subscribable_id' => $project->id, 'subscribable_type' => 'Project'])
	@endif
</div>
@stop {{-- end of content section --}}
