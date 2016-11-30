<?php

namespace Bixie\Userprofile\Controller;

use Bixie\Userprofile\Model\Profilevalue;
use Bixie\Userprofile\User\ProfileUser;
use Pagekit\Application as App;
use Pagekit\User\Model\User;
use Bixie\Userprofile\Model\Field;

class ProfileApiController {

	/**
	 * @Route("/", methods="GET")
	 * @Route("/{id}", methods="GET", requirements={"id"="\d+"})
	 */
	public function indexAction ($id = 0) {
		$self = App::user();
		$userprofile = App::module('bixie/userprofile');

		$id = $id ? : $self->id;

		if (!$self->hasAccess('user: manage users') && $id != $self->id) {
			App::abort(403, 'Insufficient permissions.');
		}
		if (!$user = User::find($id)) {
			App::abort(404, 'User not found.');
		}

		$profileUser = ProfileUser::load($user);

		return [
			'config' => $userprofile->config(),
			'fields' => array_values(Field::getProfileFields()),
			'profilevalues' => $userprofile->getProfile($user),
			'profile_user' => $profileUser,
			'user' => [
				'id' => $user->id,
				'username' => $user->username,
				'name' => $user->name,
				'email' => $user->email
			]
		];

	}

	/**
	 * @Route("/ajax", methods="POST")
	 * @Request({"field_id": "int", "action": "string"})
	 */
	public function ajaxAction ($field_id, $action) {

		if (!$field = Field::find($field_id)) {
			App::abort(400, __('Field not found.'));
		}
		$fieldValue = Profilevalue::create()->setField($field);
		$fieldType = $fieldValue->getFieldType();
		if (method_exists($fieldType, $action)) {
			return call_user_func([$fieldType,$action], $fieldValue);
		}
		return 'No response';
	}

}
