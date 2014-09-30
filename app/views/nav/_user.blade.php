<li>{{HTML::linkRoute('subscription.index', 'My Subscriptions')}}</li>
<li>{{HTML::linkRoute('project.issues', 'View All Issues', array('project_slug' => Auth::user()->project->slug))}}</li>
<li>{{HTML::linkRoute('issue.create', 'Report New Issue')}}</li>
@include('nav._logout')
