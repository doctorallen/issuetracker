<?php

class SubscriptionsController extends \BaseController {
	public function subscribe($id, $type){
		$subscription = new Subscription;
		$subscription['user_id'] = Auth::user()->id;
		$subscription['subscribable_id'] = $id;
		$subscription['subscribable_type'] = $type;

		$subscription->save();

		return Redirect::back();
	}

	public function unsubscribe($id, $type){
		$subscription = Subscription::where('subscribable_id', $id)
						->where('subscribable_type', $type)
						->where('user_id', Auth::user()->id);

		if($subscription){
			$subscription->delete();
		}

		return Redirect::back();
	}

	public function index(){
		return View::make('subscriptions.index', ['subscriptions' => Auth::user()->subscriptions()->with('subscribable')->get()]);
	}
}
