<?php

use Pagekit\Userprofile\Event\UserListener;

return [

	'name' => 'userprofile',

	'type' => 'extension',

	'main' => 'Pagekit\\Userprofile\\UserprofileModule',

	'autoload' => [

		'Pagekit\\Userprofile\\' => 'src'

	],

	'nodes' => [

	],

	'routes' => [

		'/profile' => [
			'name' => '@userprofile',
			'controller' => 'Pagekit\\Userprofile\\Controller\\ProfileController'
		],
		'/userprofile' => [
			'name' => '@userprofile/admin',
			'controller' => [
				'Pagekit\\Userprofile\\Controller\\UserprofileController',
				'Pagekit\\Userprofile\\Controller\\FieldController'
			]
		],
		'/api/userprofile/field' => [
			'name' => '@site/api/field',
			'controller' => 'Pagekit\\Userprofile\\Controller\\FieldApiController'
		]

	],

	'resources' => [

		'userprofile:' => ''

	],

	'menu' => [

		'userprofile' => [
			'label' => 'Userprofile',
			'icon' => 'extensions/userprofile/assets/images/image.svg',
			'url' => '@userprofile/admin',
			// 'access' => 'userprofile: manage hellos',
			'active' => '@userprofile(/*)'
		],

		'userprofile: fields' => [
			'label' => 'Fields',
			'parent' => 'userprofile',
			'url' => '@userprofile/admin',
			// 'access' => 'userprofile: manage hellos',
			'active' => '@userprofile(/edit)?'
		]

	],

	'permissions' => [

		'userprofile: manage settings' => [
			'title' => 'Manage settings'
		],

	],

	'settings' => 'settings-userprofile',

	'config' => [

		'override_registration' => 1

	],

	'events' => [

		'boot' => function ($event, $app) {
			$app->subscribe(new UserListener);
		},

		'request' => function ($event, $request) use ($app) {
			if ($app->config('userprofile')->get('override_registration', true) && $request->attributes->get('_route') == '@user/registration') {
				$event->setResponse($app->redirect('@profile/registration'), [], 301);
			}
		},

		'enable.userprofile' => function () use ($app) {
			// run all migrations that are newer than the current version
			if ($version = $app['migrator']->create('userprofile:migrations', $this->config('version'))->run()) {
				$app->config($this->name)->set('version', $version);
			}
			$app->config($this->name)->set('override_registration', 1); //todo shouldn't this be done by PackageController?

		},

		'disable.userprofile' => function () use ($app) {
			// disable hook
		},

		'uninstall.userprofile' => function () use ($app) {
			// downgrade all migrations
			$app['migrator']->create('userprofile:migrations', $this->config('version'))->run(0);

			// remove the config
			$app['config']->remove($this->name);
		},

		'view.scripts' => function ($event, $scripts) {
			$scripts->register('userprofile-settings', 'userprofile:app/bundle/settings.js', '~extensions');
			$scripts->register('userprofile-site', 'userprofile:app/bundle/site.js', '~site-edit');
			$scripts->register('userprofile-link', 'userprofile:app/bundle/link.js', '~panel-link');
		}

	]

];
