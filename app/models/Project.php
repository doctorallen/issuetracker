<?php

class Project extends BaseModel {
	protected $table = 'project';
	protected $guarded = [];

	protected static $rules = array(
		'name' => 'required',
		'slug' => 'required|unique:project,slug,:id:',
	);

	public function users(){
		return $this->hasMany('User');
	}

	public function subscribers(){
		$users = User::whereHas('subscriptions', function($q)
		{
			$q->where('subscribable_type', 'Project')
			  ->where('subscribable_id', $this->id);
		})->get();

		return $users;
	}

	public function issues(){
		return $this->hasMany('Issue')->orderBy('priority','asc')->orderBy('status', 'asc')->orderBy('updated_at', 'asc');
	}

	public function subscriptions(){
		return $this->morphMany('Subscription', 'subscribable');
	}

	public function userHasSubscription($user_id){ 
		$user_sub=Subscription::where('subscribable_type', 'Project')
			->where('subscribable_id',$this->id)
			->where('user_id', $user_id)
			->get();

		if(count($user_sub) > 0){
			return true;
		}

		return false;
	}

	public function getName(){
		return $this->name;
	}

	public function getLink($limit = 25){
		return HTML::linkRoute('project.show', $this->getName(), $this->id);
	}

}
