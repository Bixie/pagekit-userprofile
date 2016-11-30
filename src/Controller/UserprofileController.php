<?php

namespace Bixie\Userprofile\Controller;

use Bixie\Userprofile\Model\Field;
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
			],
            'frameworkValid' => $userprofile->checkFramework()
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
			    'fields' => array_values(Field::findAll()),
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
        App::config('bixie/userprofile')->merge($config, true)
            ->set('list', $config['list'])
            ->set('details', $config['details']);

		return ['message' => 'success'];
	}

}
