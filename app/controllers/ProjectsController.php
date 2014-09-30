<?php

class ProjectsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::all();
		return View::make('projects.index', array('projects' => $projects));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$project = new Project(Input::all());
		if( $project->save()){
			Event::fire('project.create', [$project]);
			return Redirect::route('project.index');
		}

		return Redirect::route('project.create')->withErrors($project->getErrors())->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = Project::find($id);
		return View::make('projects.show',array('project' => $project));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = Project::find($id);
		return View::make('projects.edit', array('project' => $project) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$project = Project::find($id);
		$project->fill(Input::all());
		if( $project->save() ){
			return Redirect::route('project.index');
		}

		return Redirect::route('project.edit', $project->id)->withErrors($project->getErrors())->withInput();
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
	
	public function issues($project_slug){

		//grab the project
		$project = Project::whereSlug($project_slug)->with('issues')->first();

		//if the user doesn't have access to this project, redirect them home
		if(!Auth::user()->projectAccess($project->id)) return Redirect::route('home');

		return View::make('projects.issues', array('project' => $project));

	}

}
