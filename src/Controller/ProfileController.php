<?php

namespace Bixie\Userprofile\Controller;

use Bixie\Userprofile\User\ProfileUser;
use Pagekit\Application as App;

class ProfileController {

	/**
	 * main profile edit page
	 * @Route("/", methods="GET")
	 */
	public function indexAction () {
		$user = App::user();
		$userprofile = App::module('bixie/userprofile');

		if (!$user->isAuthenticated()) {
			return App::redirect('@user/login', ['redirect' => App::url()->current()]);
		}

        $profileUser = ProfileUser::load($user);

		return [
			'$view' => [
				'title' => __('Your Profile'),
				'name' => 'bixie/userprofile/profile-edit.php'
			],
			'$data' => [
				'config' => $userprofile->config(),
				'user' => [
					'id' => $user->id,
					'username' => $user->username,
					'name' => $user->name,
					'email' => $user->email
				]
			],
            'profileUser' => $profileUser
		];

	}

	/**
	 * registration override page
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
