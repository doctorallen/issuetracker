<div class="comment col-sm-10 col-sm-offset-1 comment-form">
	{{Form::open(array('route' => 'comment.store'))}}
		{{ $errors->first('comment', '<span class="error">:message</span>') }}
		<input type="hidden" name="issue_id" value="{{$issue->id}}">
		<textarea name="comment" cols=50 rows=5></textarea>
		{{Form::submit('CREATE', array('class' => 'btn btn-success pull-right')) }}
{{ Form::close() }}
</div>

