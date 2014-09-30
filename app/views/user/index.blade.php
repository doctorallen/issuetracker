@extends('layouts.master')
@section('title', 'User List');
@section('content')
	<h1>User List</h1>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<th>Username</th>
				<th>Project Name</th>
				<th>User Level</th>
				<th>View Issues</th>
				<th>Updated Date</th>
			</thead>
			<tbody>
				@foreach ($users as $user)
				<tr>
					<td>{{HTML::linkRoute('user.show',$user->username, $user->id)}}</td>
					<td>{{$user->project->name}}</td>
					<td>@if($user->permission_level == 0)Admin @else Client @endif</td>
					<td>{{HTML::linkRoute('user.issues', 'View Issues (' . count($user->issues). ')', $user->id)}}</td>
					<td>{{clean_date($user->updated_at) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop {{-- end of content section --}}
