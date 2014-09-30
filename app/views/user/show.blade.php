@extends('layouts.master')
@section('title'){{$user->username}}@stop
@section('content')
<h1>Viewing User - {{$user->username}}</h1>
<div class="row">
	<div class="col-sm-5 ">
		<label>Email:</label>
	</div>
	<div class="col-sm-7">
		{{$user->email}}
	</div>
</div>
<div class="row">
	<div class="col-sm-5 ">
		<label>Username:</label>
	</div>
	<div class="col-sm-7">
		{{$user->username}}
	</div>
</div>
<div class="row">
	<div class="col-sm-5 ">
		<label>Project:</label>
	</div>
	<div class="col-sm-7">
		{{$user->project->name}}
	</div>
</div>
<div class="clear"></div>
<div class="actions">
	{{HTML::linkRoute('user.edit',"EDIT", $user->id, array('class' => 'btn btn-primary btn-lg'))}}
	{{HTML::linkRoute('user.issues','View Issues', $user->id, array('class' =>'btn btn-success btn-lg'))}}
</div>
@stop {{-- end of content section --}}
