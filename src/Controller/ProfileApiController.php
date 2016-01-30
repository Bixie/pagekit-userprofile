<?php

namespace Bixie\Userprofile\Controller;

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

		return [
			'config' => $userprofile->config(),
			'fields' => array_values(Field::getProfileFields()),
			'profilevalues' => $userprofile->getProfile($user),
			'user' => [
				'id' => $user->id,
				'username' => $user->username,
				'name' => $user->name,
				'email' => $user->email
			]
		];

	}

}
