<?php

use Pagekit\Userprofile\Event\UserListener;

return [

	'name' => 'bixie/userprofile',

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
		],
		'/api/userprofile/profile' => [
			'name' => '@site/api/profile',
			'controller' => 'Pagekit\\Userprofile\\Controller\\ProfileApiController'
		]

	],

	'resources' => [

		'userprofile:' => ''

	],

	'menu' => [

		'userprofile' => [
			'label' => 'Userprofile',
			'icon' => 'packages/bixie/userprofile/icon.svg',
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
				$event->setResponse($app->redirect('@userprofile/registration'), [], 301);
			}
		},

		'view.scripts' => function ($event, $scripts) use ($app) {
			$scripts->register('userprofile-settings', 'userprofile:app/bundle/settings.js', '~extensions');
			$scripts->register('node-userprofile', 'userprofile:app/bundle/node-userprofile.js', '~site-edit');
			$scripts->register('link-userprofile', 'userprofile:app/bundle/link-userprofile.js', '~panel-link');
			$scripts->register('user-section-userprofile', 'userprofile:app/bundle/user-section-userprofile.js', ['~users', 'userprofile-profilefields']);
			//register fields
			$scripts->register('userprofile-profilefields', 'userprofile:app/bundle/userprofile-profilefields.js', 'vue');
			$userprofile = $app->module('userprofile');
			foreach ($userprofile->getTypes() as $type) {
				$scripts->register(
					'userprofile-' . $type['id'], 'userprofile:app/bundle/userprofile-' . $type['id'] . '.js',
					array_merge(['~userprofile-profilefields'], $type['dependancies'])
				);
			}
		},

		'view.styles' => function ($event, $styles) use ($app) {
			//todo this should be prettier
			$route = $app->request()->attributes->get('_route');
			if (strpos($route, '@userprofile') === 0 || in_array($route, ['@user/edit'])) {
				$userprofile = $app->module('userprofile');
				foreach ($userprofile->getTypes() as $type) {
					if (isset($type['style'])) {
						foreach ($type['style'] as $name => $source) {
							$styles->add($name, $source);

						}
					}
				}
			}
		}

	]

];
