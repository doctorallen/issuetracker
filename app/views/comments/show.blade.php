<div class="comment col-sm-10 col-sm-offset-1">
@if(Auth::user()->isAdmin() || ($comment->user_id === Auth::user()->id)) 
	{{ Form::open(array('route' => array('comment.destroy', $comment->id), 'method' => 'DELETE', 'class' => 'pull-right comment-delete-form')) }}
		{{ Form::submit('Delete', array('class' => 'btn btn-danger btn-sm')) }}
	{{ Form::close() }}
@endif
	<div class="comment-meta">
		<span class="comment-user">{{$comment->user->username}}</span> said on
		<span class="comment-date">{{clean_date($comment->updated_at)}}</span>
	</div>
	<div class="issue-value comment-text">{{$comment->comment}}</div>
</div>
