@extends('layouts.master')
@section('title', 'Project List');
@section('content')
<h1>Project List</h1>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Project Name</th>
			<th>Project Slug</th>
			<th>View Issues</th>
			<th>Last Updated</th>
		</thead>
		<tbody>
			@foreach ($projects as $project)
			<tr>
				<td>{{$project->id}}</td>
				<td>{{HTML::linkRoute('project.show',$project->name, $project->id)}}</td>
				<td>{{$project->slug}}</td>
				<td>{{HTML::linkRoute('project.issues', 'View Issues (' . count($project->issues). ')', array('project_slug' => $project->slug))}}</td>
				<td>{{clean_date($project->updated_at) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop {{-- end of content section --}}
