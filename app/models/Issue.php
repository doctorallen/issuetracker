<?php

class Issue extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'issues';

	protected $fillable = array(
		'email',
		'url',
		'type',
		'steps',
		'expectation',
		'browser',
		'actual',
		'project_id',
		'status',
		'priority',
	);

	protected static $rules = array(
		'project_id'  => 'required',
		'email'       => 'required|email',
		'url'         => 'required|url',
		'type'        => 'required',
		'steps'       => 'required',
		'expectation' => 'required',
		'actual'      => 'required',
	);

	protected static $messages = array(
		'steps.required'       => 'This field is required.',
		'expectation.required' => 'This field is required.',
		'actual.required'      => 'This field is required.',
		'url.url'              => 'Please enter the URL shown in your browser\'s address bar.',
	);

	public function project(){
		return $this->belongsTo('Project');
	}

	public function comments(){
		return $this->hasMany('Comment')->orderBy('created_at', 'desc');
	}

	public function user(){
		return $this->belongsTo('User');
	}

	public function subscribers(){
		$users = User::whereHas('subscriptions', function($q)
		{
			$q->where('subscribable_type', 'Issue')
			  ->where('subscribable_id', $this->id);
		})->get();

		return $users;
	}

	public function subscriptions(){
		return $this->morphMany('Subscription', 'subscribable');
	}

	public function userHasSubscription($user_id){ 
		$user_sub=Subscription::where('subscribable_type', 'Issue')
			->where('subscribable_id',$this->id)
			->where('user_id', $user_id)
			->get();

		if(count($user_sub) > 0){
			return true;
		}

		return false;
	}

	public function getName($limit = 35){
		return Str::limit($this->actual, $limit);
	}

	public function getLink($limit = 25){
		return HTML::linkRoute('issue.show', $this->getName($limit), $this->id);
	}
}
