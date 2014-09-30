@extends('layouts.master')
@section('title'){{$user->username}}'s Submitted Issues @stop
@section('content')
<h1>{{$user->username}}'s Submitted Issues</h1>
	@if(count($user->issues) > 0 )
		@if(count($user->issues()->where('status', '!=', 'Closed')->get()) > 0)
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<th>Issue ID</th>
					<th>Description</th>
					<th>Project</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Date Updated</th>
				</thead>
				<tbody>
				@foreach ($user->issues as $issue)
					@if($issue->status != 'Closed')
						<tr class="status-{{$issue->status}}">
								<td>{{HTML::linkRoute('issue.show',"Issue #$issue->id", $issue->id)}}</td>
								<td>{{Str::limit($issue->actual, 35)}}</td>
								<td>{{$issue->Project->name}}</td>
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
		@if(count($user->issues()->whereStatus('Closed')->get()) > 0)
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
				@foreach ($user->issues as $issue)
					@if($issue->status == 'Closed')
						<tr class="status-{{$issue->status}}">
								<td>{{HTML::linkRoute('issue.show',"Issue #$issue->id", $issue->id)}}</td>
								<td>{{Str::limit($issue->actual, 35)}}</td>
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
