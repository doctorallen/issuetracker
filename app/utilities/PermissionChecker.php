<?php
class PermissionChecker{
	public function atLeast($level){
		return Auth::user()->username;
	}
}
