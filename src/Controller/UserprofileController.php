<?php

namespace Bixie\Userprofile\Controller;

use Pagekit\Application as App;

/**
 * @Access(admin=true)
 */
class UserprofileController {
	public function indexAction () {
		$userprofile = App::module('bixie/userprofile');

		return [
			'$view' => [
				'title' => __('Userprofile'),
				'name' => 'bixie/userprofile/admin/fields.php'
			],
			'$data' => [
				'config' => App::module('bixie/userprofile')->config('default'),
				'types' => $userprofile->getFieldTypes()
			]
		];
	}

}
