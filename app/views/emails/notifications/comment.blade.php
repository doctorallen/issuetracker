<h1>At {{clean_time($comment['updated_at'])}} {{$username}} said:</h1>
<p>
{{$comment['comment']}}
</p>
{{HTML::linkRoute('issue.show',"Issue #$issue_id", $issue_id)}}
