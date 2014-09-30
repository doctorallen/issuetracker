<?php

class CommentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::route('home');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Redirect::route('home');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$comment = new Comment(Input::all());
		$comment->user_id = Auth::user()->id;

		if( $comment->save()){
			Event::fire('comment.create',[$comment]);

			//return Redirect::route('project.issues', array('project_slug' => $issue->project->slug));
		}

		return Redirect::route('issue.show', array('id' => Input::get('issue_id')))->withErrors($comment->getErrors())->withInput();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Redirect::route('home');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return Redirect::route('home');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return Redirect::route('home');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$comment = Comment::find($id);

		//only allow admins, or the user who created the comment to delete it
		if(Auth::user()->isAdmin() || ($comment->user_id === Auth::user()->id)){ 
			$comment->delete();
		}

		return Redirect::route('issue.show', array('id' => $comment->issue_id));
	}


}
