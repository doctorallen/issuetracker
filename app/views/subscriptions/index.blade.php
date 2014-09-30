@extends('layouts.master')
@section('title', 'My Subscriptions');
@section('content')
<h1>My Subscriptions</h1>
@if(count($subscriptions) > 0)
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th>Type</th>
			<th>Link</th>
			<th>UnSubscribe</th>
		</thead>
		<tbody>
			@foreach ($subscriptions as $subscription)
			<tr>
				<td>{{$subscription->subscribable_type}}</td>
				<td>{{$subscription->subscribable->getLink()}}</td>
				<td>@include('subscriptions.unsubscribe', ['subscribable_id' => $subscription->subscribable_id, 'subscribable_type' => $subscription->subscribable_type])</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	<div class="no-data">You have no subscriptions</div>	
@endif
@stop {{-- end of content section --}}
