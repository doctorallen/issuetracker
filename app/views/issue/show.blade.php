@extends('layouts.master')
@section('title')Issue #{{$issue->id}}@stop
@section('content')
<div class="row issue-show-header">
	<div class="col-sm-3 issue-show-badge">
		<div class="label label-type-{{$issue->type}}">{{$issue->type}}</div>
		<div class="label label-priority-{{$issue->priority}}">{{$issue->priority}}</div>
	</div>
	<div class="col-sm-5 issue-show-title">
		<h1>Issue #{{$issue->id}} - {{$issue->status}}</h1>
	</div>

	<div class="subscription-form pull-right">
		@if($issue->userHasSubscription(Auth::user()->id))
				@include('subscriptions.unsubscribe', ['subscribable_id' => $issue->id, 'subscribable_type' => 'Issue'])
		@else
				@include('subscriptions.subscribe', ['subscribable_id' => $issue->id, 'subscribable_type' => 'Issue'])
		@endif
	</div>
	<div class="col-sm-4 issue-detail-dates">
		<div class="row">
			<div class="col-sm-6 text-right">
				Created: 
			</div>
			<div class="col-sm-6">
				<span class="issue-detail-date">{{clean_date($issue->created_at)}}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 text-right">
				Updated:
			</div>
			<div class="col-sm-6">
				<span class="issue-detail-date">{{clean_date($issue->updated_at)}}</span>
			</div>
		</div>
	</div>
</div>
<div class="row issue-show">
	<div class="col-sm-8 issue-list-container">
		@if(Auth::user()->isAdmin())
			<div class="row">
				<label>Reported by</label>
				<div class="issue-value issue-user">{{HTML::linkRoute('user.show',$issue->user->username, $issue->user->id)}}</div>
			</div>
		@endif
			
			<div class="row">
					<label>Email</label>
					<div class="issue-value issue-email">{{$issue->email}}</div>
			</div>
			<div class="row">
					<label>URL</label>
					<a href="{{$issue->url}}">{{$issue->url}}</a>
			</div>
			<div class="row">
					<label>Detailed explanation of the issue</label>
					<div class="issue-value issue-actual">{{$issue->actual}}</div>
			</div>
			<div class="row">
					<label>Detailed explanation of expected results</label>
					<div class="issue-value issue-expectation">{{$issue->expectation}}</div>
			</div>
			<div class="row">
					<label>Steps to reproduce</label>
					<div class="issue-value issue-steps">{{$issue->steps}}</div>
			</div>
			<div class="row">
					<a data-toggle="collapse" data-target=".issue-browser"><label>Browser Settings (click to expand)</label></a>
					<div class="issue-value issue-browser collapse">{{$issue->browser}}</div>
			</div>
			@if($issue->screenshot)
			<div class="row">
					<label>Screenshot</label>
					<a href="/images/{{$issue->screenshot}}">{{ HTML::image('images/' . $issue->screenshot, 'Screenshot')}}</a>
			</div>
			@endif

		<div class="actions">
		@if(Auth::user()->isAdmin())
			{{HTML::linkRoute('issue.edit',"EDIT", $issue->id, array('class' => 'btn btn-primary btn-lg'))}}
		@endif
		<a href="#add_comment" class="btn btn-warning btn-lg reply-button">COMMENT</a>
		</div>

		@if(count($issue->comments) > 0)
			<h1>Comments</h1>
		@else
			<div class="no-data">No comments to display</div>
		@endif

		@include('comments.create')

		@foreach($issue->comments as $comment)
			@include('comments.show')
		@endforeach
	</div>
	<div class="col-sm-4">
		@include('issue.issue-list')
	</div>
</div>
@stop {{-- end of content section --}}
