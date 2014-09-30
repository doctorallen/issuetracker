@extends('layouts.master')
@section('title'){{$project->name}} Issue List @stop
@section('content')
<h1>{{$project->name}} Issue List</h1>
<div class="subscription-form pull-right">
	@if($project->userHasSubscription(Auth::user()->id))
		{{Form::open(['route' => ['subscription.delete', 'id' => $project->id, 'type'=> 'Project']])}}
			{{Form::submit('UNSUBSCRIBE', array('class' => 'btn btn-info btn-sm'))}}
		{{Form::close()}}
	@else
		{{Form::open(['route' => ['subscription.create', 'id' => $project->id, 'type'=> 'Project']])}}
			{{Form::submit('SUBSCRIBE', array('class' => 'btn btn-success btn-sm'))}}
		{{Form::close()}}
	@endif
</div>
		@if(count($project->issues) > 0 )
			@if(count($project->issues()->where('status', '!=', 'Closed')->get()) > 0)
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<th>Issue ID</th>
					<th>Description</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Date Updated</th>
				</thead>
				<tbody>
				@foreach ($project->issues as $issue)
					@if($issue->status != 'Closed')
						<tr class="status-{{$issue->status}}">
								<td>{{HTML::linkRoute('issue.show',"Issue #$issue->id", $issue->id)}}</td>
								<td>{{$issue->getName()}}</td>
								<td class="status-{{$issue->status}}">{{$issue->status}}</td>
								<td class="priority-{{$issue->priority}}">{{$issue->priority}}</td>
								<td>{{clean_date($issue->updated_at) }}</td>
						</tr>
					@endif
				@endforeach
				</tbody>
			</table>
		</div>
		@else
			<div class="no-data">No new issues to display</div>	
		@endif
		@if(count($project->issues()->whereStatus('Closed')->get()) > 0)
			<h2>Closed Issues</h2>

		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<th>Issue ID</th>
					<th>Description</th>
					<th>Status</th>
					<th>Date Updated</th>
				</thead>
				<tbody>
				@foreach ($project->issues as $issue)
					@if($issue->status == 'Closed')
						<tr class="status-{{$issue->status}}">
								<td>{{HTML::linkRoute('issue.show',"Issue #$issue->id", $issue->id)}}</td>
								<td>{{$issue->getName()}}</td>
								<td class="status-{{$issue->status}}">{{$issue->status}}</td>
								<td>{{clean_date($issue->updated_at) }}</td>
						</tr>
					@endif
				@endforeach
				</tbody>
			</table>
		</div>
		@endif
		@else
			<div class="no-data">No issues to display</div>	
		@endif
@stop {{-- end of content section --}}
