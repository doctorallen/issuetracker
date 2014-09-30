<?php

class Comment extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	protected $fillable = array(
		'issue_id',
		'comment',
	);

	protected static $rules = array(
		'comment' => 'required',
	);

	public function issue(){
		return $this->belongsTo('Issue');
	}

	public function user(){
		return $this->belongsTo('User');
	}
}
