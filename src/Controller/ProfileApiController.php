<?php

namespace Pagekit\Userprofile\Controller;

use Pagekit\Application as App;
use Pagekit\User\Model\User;
use Pagekit\Userprofile\Model\Field;
use Pagekit\Userprofile\Model\Profilevalue;

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
			'fields' => Field::getProfileFields(),
			'profilevalues' => Profilevalue::getUserProfilevalues($user),
			'user' => [
				'id' => $user->id,
				'username' => $user->username,
				'name' => $user->name,
				'email' => $user->email
			]
		];

	}

}
