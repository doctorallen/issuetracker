<?php

class Subscription extends Eloquent {

	protected $fillable = array(
		'user_id',
		'subscribable_id',
		'subscribable_type'
	);

	public function subscribable(){
		return $this->morphTo();
	}

	public function user(){
		return $this->belongsTo('User');
	}
}
