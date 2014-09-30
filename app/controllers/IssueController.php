<?php

class IssueController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Auth::user()->isAdmin()) return Redirect::route('home');

		$issues = Issue::orderBy('status', 'id')->get();
		return View::make('issue.index', array('issues'=> $issues));	
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$projects = Project::all();
		return View::make('issue.create', array('projects' => $projects));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$issue = new Issue(Input::all());

		//give a default status to all new issues
		$issue->status = "Open";

		//we use a hidden field on the input form for the project id
		//but we don't want a use to able to change it, so we override the 
		//project id from input with that user's actual prioject id
		
		if(!Auth::user()->isAdmin()){
			$issue->project_id = auth::user()->project_id;
		}
		$issue->user_id = Auth::user()->id;

		if( Input::hasFile('screenshot') ){
			$screenshot = Input::file('screenshot');
			$name = time() . '-' . $screenshot->getClientOriginalName();

			$screenshot->move(public_path().'/images/',$name);

			$issue->screenshot = $name;
		}

		if( $issue->save()){
			Event::fire('issue.create', [$issue]);
			return Redirect::route('project.issues', array('project_slug' => $issue->project->slug));
		}

		return Redirect::route('issue.create')->withErrors($issue->getErrors())->withInput();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$issue = Issue::whereId($id)->with('user', 'comments', 'comments.user')->first();	
		$project = Project::whereSlug($issue->project->slug)->with('issues')->first();
		if(!Auth::user()->projectAccess($issue->project_id)) return Redirect::route('home');
		return View::make('issue.show', array('issue' => $issue, 'project' => $project));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!Auth::user()->isAdmin()) return Redirect::route('home');

		$issue = Issue::find($id);	
		return View::make('issue.edit', array('issue' => $issue));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!Auth::user()->isAdmin()) return Redirect::route('home');

		$issue = Issue::find($id);
		$issue->fill(Input::all());

		if( Input::hasFile('screenshot') ){
			$screenshot = Input::file('screenshot');
			$name = time() . '-' . $screenshot->getClientOriginalName();

			$screenshot->move(public_path().'/images/',$name);

			$issue->screenshot = $name;
		}

		if( $issue->save() ){
			Event::fire('issue.update', [$issue]);
			return Redirect::route('issue.show', $issue->id);
		}

		return Redirect::route('issue.edit', $issue->id)->withErrors($issue->getErrors())->withInput();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
