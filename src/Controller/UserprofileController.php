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

	/**
	 * @Access("system: access settings")
	 */
	public function settingsAction () {
		return [
			'$view' => [
				'title' => __('Userprofile settings'),
				'name' => 'bixie/userprofile/admin/settings.php'
			],
			'$data' => [
				'config' => App::module('bixie/userprofile')->config()
			]
		];
	}

	/**
	 * @Access("system: access settings")
	 * @Request({"config": "array"}, csrf=true)
	 */
	public function configAction($config = [])
	{
		App::config('bixie/userprofile')->merge($config, true);

		return ['message' => 'success'];
	}

}
