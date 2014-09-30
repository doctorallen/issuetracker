<?php
Event::listen('issue.create', function($issue)
{
	//we want the creator of this issue to be subscribed to it
	$issue->subscriptions()->create(['user_id' => Auth::user()->id]);

	$issue_subscribers = $issue->subscribers();
	$project_subscribers = $issue->project->subscribers(); 
	$subscribers = $issue_subscribers->merge($project_subscribers);

	$data = [
		'issue_id' => $issue->id,
		'title' => 'New Issue Created'
	];

	foreach($subscribers as $subscriber){
		$email = $subscriber->email;
		Mail::queue('emails.notifications.issue', $data, function($message) use ($email, $data)
		{
			$message->to($email)->subject($data['title']);
		});
	}

});

Event::listen('issue.update', function($issue)
{
	//check if the subscription already exists
	if(!$issue->userHasSubscription(Auth::user()->id)){
		//if not, create it
		$issue->subscriptions()->create(['user_id' => Auth::user()->id]);
	}

	$issue_subscribers = $issue->subscribers();
	$project_subscribers = $issue->project->subscribers(); 
	$subscribers = $issue_subscribers->merge($project_subscribers);

	$data = [
		'issue_id' => $issue->id,
		'title' => 'Issue #'.$issue->id.' Edited',
	];

	foreach($subscribers as $subscriber){
		$email = $subscriber->email;
		Mail::queue('emails.notifications.issue', $data, function($message) use ($email, $data)
		{
			$message->to($email)->subject($data['title']);
		});
	}
});

Event::listen('comment.create', function($comment)
{
	//check if the subscription already exists
	if(!$comment->issue->userHasSubscription(Auth::user()->id)){
		//if not, create it
		$comment->issue->subscriptions()->create(['user_id' => Auth::user()->id]);
	}

	$issue_subscribers = $comment->issue->subscribers();
	$project_subscribers = $comment->issue->project->subscribers(); 
	$subscribers = $issue_subscribers->merge($project_subscribers);

	$data = [
		'title' => 'Comment Added To Issue #'.$comment->issue->id,
		'comment' => $comment->toArray(),
		'username' => $comment->user->username,
		'issue_id' => $comment->issue->id
	];

	foreach($subscribers as $subscriber){
		$email = $subscriber->email;
		Mail::queue('emails.notifications.comment', $data, function($message) use ($email, $data)
		{
			$message->to($email)->subject($data['title']);
		});
	}
	
});

Event::listen('project.create', function($project)
{
	//we want the creator of this project to be subscribed to it
	$project->subscriptions()->create(['user_id' => Auth::user()->id]);

});
