<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	protected $fillable = array('email', 'username','password','project_id','permission_level');

	protected static $rules = array(
		'email' => 'required|email',
		'username' => 'required|unique:users,username,:id:',
		'password' => 'required',
		'project_id' => 'required',
		'permission_level' => 'required'
	);

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function isAdmin(){
		if( $this->permission_level < 1 ){
			return true;
		}

		return false;
	}

	public function projectAccess($project_id){
		if($this->isAdmin()) return true;

		if($this->project_id == $project_id){
			return true;
		}else{
			return false;
		}
	}

	public function project(){
		return $this->belongsTo('Project');
	}

	public function setPasswordAttribute($value){
		if(!empty($value)){	
			$this->attributes['password'] = Hash::make($value);
		}
	}

	public function comments(){
		return $this->hasMany('Comment');
	}

	public function issues(){
		return $this->hasMany('Issue')->orderBy('project_id', 'asc')->orderBy('priority', 'asc');	
	}

	public function subscriptions(){
		return $this->hasMany('Subscription');
	}

}
