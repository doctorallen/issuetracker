<?php

class UserController extends \BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::with('project')->get();
		return View::make('user.index', array('users'=> $users ));	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$projects = Project::all();
		return View::make('user.create', array('projects' => $projects));	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User(Input::all());	
		if( $user->save() ){
			//hash the password
			return Redirect::route('user.index');
		}

		return Redirect::route('user.create')->withErrors($user->getErrors())->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		return View::make('user.show', array('user' => $user)); 
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$projects = Project::all();
		$user = User::find($id);
		return View::make('user.edit', array('user' => $user,'projects' => $projects)); 
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		$user->fill(Input::all());
		if( $user->save() ){
			return Redirect::route('user.index');
		}

		return Redirect::route('user.edit', $user->id)->withErrors($user->getErrors())->withInput();
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

	public function issues($user_id){

		//grab the project
		$user = User::whereId($user_id)->with('issues')->first();

		return View::make('user.issues', array('user' => $user));

	}

}
