<?php

namespace Bixie\Userprofile\Controller;

use Pagekit\Application as App;
use Bixie\Userprofile\Model\Field;

class ProfileController {
	public function indexAction () {
		$user = App::user();
		$userprofile = App::module('bixie/userprofile');

		if (!$user->isAuthenticated()) {
			return App::redirect('@user/login', ['redirect' => App::url()->current()]);
		}

		return [
			'$view' => [
				'title' => __('Your Profile'),
				'name' => 'bixie/userprofile/profile.php'
			],
			'$data' => [
				'config' => $userprofile->config(),
				'user' => [
					'id' => $user->id,
					'username' => $user->username,
					'name' => $user->name,
					'email' => $user->email
				]
			]
		];

	}

	/**
	 * @Route("/registration")
	 */
	public function registrationAction () {

		$user = App::user();
		$userprofile = App::module('bixie/userprofile');

		if ($user->isAuthenticated()) {
			return App::redirect('@userprofile');
		}

		return [
			'$view' => [
				'title' => __('User registration'),
				'name' => 'bixie/userprofile/registration.php'
			],
			'$data' => [
				'config' => $userprofile->config(),
				'user' => [
					'id' => null,
					'username' => '',
					'name' => '',
					'email' => ''
				]
			]
		];

	}
}
