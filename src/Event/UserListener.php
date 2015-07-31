<?php

namespace Pagekit\Userprofile\Event;

use Pagekit\Application as App;
use Pagekit\Event\EventSubscriberInterface;
use Pagekit\User\Model\User;
use Pagekit\Userprofile\Model\Profilevalue;

class UserListener implements EventSubscriberInterface {

	protected $request;

	public function onRequest ($event, $request) {
		//todo this shouldn't be the way
		$this->request = $request;
	}

	public function onUserAdminProfile ($event, $view) {

//		$event->setResult('hoi!');
		return;
	}

	public function onUserChange ($event, User $user) {
		/** @var \Pagekit\Userprofile\Model\Profilevalue $profilevalue */
		foreach ($this->request->request->get('profilevalues') as $data) {
			// is new ?
			if (!$profilevalue = Profilevalue::find($data['id'])) {

				if ($data['id']) {
					App::abort(404, __('Userprofilevalue not found.'));
				}

				$profilevalue = Profilevalue::create();
			}
			$profilevalue->field_id = $data['field_id'];
			$profilevalue->user_id = $user->id;
			$profilevalue->multiple = $data['multiple'];
			$profilevalue->setValue($data['value']);

			$profilevalue->save();

		}
	}

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
			'request' => 'onRequest',
			'view.system/user:views/admin/user-edit' => 'onUserAdminProfile',
			'model.user.saved' => 'onUserChange',
			'model.user.deleted' => 'onUserDeleted'
		];
	}
}
