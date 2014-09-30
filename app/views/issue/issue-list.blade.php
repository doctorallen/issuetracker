<div class="issue-list-sidebar">
@if(count($project->issues) > 0 )
	@if(count($project->issues()->where('status', '!=', 'Closed')->get()) > 0)
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<th>ID</th>
					<th>Description</th>
					<th>Status</th>
				</thead>
				@foreach ($project->issues as $issue)
					@if($issue->status != 'Closed')
						<tr class="status-{{$issue->status}}">
								<td>#{{$issue->id}}</td>
								<td><span class="priority-badge priority-badge-{{$issue->priority}}"> </span>{{$issue->getLink(25)}}</td>
								<td class="status-{{$issue->status}}">{{$issue->status}}</td>
						</tr>
					@endif
				@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="no-data">No new issues to display</div>	
	@endif
@else
	<div class="no-data">No issues to display</div>	
@endif
</div>
