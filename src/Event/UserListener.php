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
			$profilevalue->setFieldId($data['field_id']);
			$profilevalue->setUserId($data['user_id']);
			$profilevalue->setMultiple($data['multiple']);
			$profilevalue->setValue($data['value']);

			$profilevalue->save();

		}
	}

	public function onUserDeleted () {
		//todo delte profilevalues
	}


	/**
	 * {@inheritdoc}
	 */
	public function subscribe () {
		return [
			'request' => 'onRequest',
			'model.user.saved' => 'onUserChange',
			'model.user.deleted' => 'onUserDeleted'
		];
	}
}
