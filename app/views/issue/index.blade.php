@extends('layouts.master')
@section('content')
<h1>Issue List</h1>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th>Issue ID</th>
			<th>Description</th>
			<th>Status</th>
			<th>Date Updated</th>
		</thead>
		<tbody>
			@foreach ($issues as $issue)
			<tr class="status-{{$issue->status}}">
					<td>{{HTML::linkRoute('issue.show',"Issue #$issue->id", $issue->id)}}</td>
					<td>{{$issue->getName()}}</td>
					<td>{{$issue->status}}</td>
					<td>{{clean_date($issue->updated_at) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop {{-- end of content section --}}
