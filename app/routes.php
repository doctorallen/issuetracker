<?php
/*
Event::listen('illuminate.query', function($query, $bind){
	echo '<div class="query-log">';
	var_dump($query);
	var_dump($rind);
	echo '</div>';
});
 */


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
// Route::when('*', 'csrf', array('post', 'put','delete'));

Route::get('home', array('as' => 'home', 'uses' => 'AuthenticationController@home'));
Route::get('/', array('uses' => 'AuthenticationController@home'));
Route::get('login', array('as' => 'account.form', 'uses' => 'AuthenticationController@loginform'));
Route::post('login', array('as' => 'account.login', 'uses' => 'AuthenticationController@login'));

Route::group(array('prefix' => 'password'), function(){
	Route::get('remind', array('as' => 'password.remind', 'uses' => 'RemindersController@getRemind'));
	Route::post('remind', array('as' => 'password.remindpost', 'uses' => 'RemindersController@postRemind'));
	Route::get('reset/{token}', array('as' => 'password.reset', 'uses' => 'RemindersController@getReset'));
	Route::post('reset', array('as' => 'password.resetpost', 'uses' => 'RemindersController@postReset'));
});


Route::group(array( 'before' => 'auth'), function()
{
	Route::post('logout', array('as' => 'account.logout', 'uses' => 'AuthenticationController@logout'));

	Route::post('subscription/create/{id}/{type}', ['as' => 'subscription.create', 'uses' => 'SubscriptionsController@subscribe']);
	Route::post('subscription/delete/{id}/{type}', ['as' => 'subscription.delete', 'uses' => 'SubscriptionsController@unsubscribe']);
	Route::get('subscriptions', ['as' => 'subscription.index', 'uses' => 'SubscriptionsController@index']);

	Route::resource('issue', 'IssueController');

	Route::resource('comment', 'CommentController');

	Route::group(array( 'before' => 'auth.admin'), function()
	{
		Route::resource('user','UserController');
		Route::get('user/{user_id}/issues',array('as' => 'user.issues', 'uses' => 'UserController@issues'));
		Route::resource('project', 'ProjectsController');
	});

	Route::get('{project_slug}/issues',array('as' => 'project.issues', 'uses' => 'ProjectsController@issues'));
});
