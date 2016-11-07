<?php

namespace Bixie\Userprofile\Event;

use Bixie\Userprofile\User\ProfileUser;
use Pagekit\Application as App;
use Pagekit\Event\EventSubscriberInterface;
use Pagekit\User\Model\User;
use Bixie\Userprofile\Model\Profilevalue;

class UserListener implements EventSubscriberInterface {

	protected $request;

	/**
	 * @param      $event
	 * @param User $user
	 */
	public function onUserChange ($event, User $user) {
		$profilevalues = App::request()->request->get('profilevalues', []);
		if (count($profilevalues)) {
			$profileUser = ProfileUser::load($user);
			$profileUser->setProfileValues($profilevalues);
			$profileUser->saveProfile();
            //only save once
            App::request()->request->set('profilevalues', []);
		}
	}

	/**
	 * @param      $event
	 * @param User $user
	 */
	public function onUserDeleted ($event, User $user) {
		foreach (Profilevalue::where(['user_id = :id'], [':id' => $user->id])->get() as $profilevalue) {
			$profilevalue->delete();
		}
	}


	/**
	 * {@inheritdoc}
	 */
	public function subscribe () {
		return [
			'model.user.created' => 'onUserChange',
			'model.user.saved' => 'onUserChange',
			'model.user.deleted' => 'onUserDeleted'
		];
	}
}
