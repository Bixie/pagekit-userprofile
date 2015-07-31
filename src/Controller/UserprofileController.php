<?php

namespace Pagekit\Userprofile\Controller;

use Pagekit\Application as App;

/**
 * @Access(admin=true)
 */
class UserprofileController {
	public function indexAction () {
		$userprofile = App::module('userprofile');

		return [
			'$view' => [
				'title' => __('Userprofile'),
				'name' => 'userprofile:views/admin/fields.php'
			],
			'$data' => [
				'config' => App::module('userprofile')->config('default'),
				'types' => $userprofile->getTypes()
			]
		];
	}

}
