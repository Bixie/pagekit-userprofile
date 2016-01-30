<?php

namespace Bixie\Userprofile\Event;

use Pagekit\Application as App;
use Pagekit\Event\EventSubscriberInterface;
use Pagekit\User\Model\User;
use Bixie\Userprofile\Model\Profilevalue;

class UserListener implements EventSubscriberInterface {

	protected $request;

	public function onUserChange ($event, User $user) {
		/** @var \Bixie\Userprofile\Model\Profilevalue $profilevalue */
		foreach (App::request()->request->get('profilevalues', []) as $field_value) {
			// is new ?
			if (!$profilevalue = Profilevalue::find($field_value['data']['id'])) {

				if ($field_value['data']['id']) {
					App::abort(404, __('Userprofilevalue not found.'));
				}

				$profilevalue = Profilevalue::create();
			}
			$profilevalue->field_id = $field_value['field']['id'];
			$profilevalue->user_id = $user->id;
			$profilevalue->multiple = isset($field_value['field']['data']['multiple']) && $field_value['field']['data']['multiple'] == 1 ? 1 : 0;
			$profilevalue->setValue($field_value['value']);

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
			'model.user.saved' => 'onUserChange',
			'model.user.deleted' => 'onUserDeleted'
		];
	}
}
