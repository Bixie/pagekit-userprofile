<?php

use Bixie\Userprofile\Event\UserListener;

return [

	'name' => 'bixie/userprofile',

	'type' => 'extension',

	'main' => 'Bixie\\Userprofile\\UserprofileModule',

	'autoload' => [

		'Bixie\\Userprofile\\' => 'src'

	],

	'nodes' => [

	],

	'routes' => [

		'/profile' => [
			'name' => '@userprofile',
			'controller' => 'Bixie\\Userprofile\\Controller\\ProfileController'
		],
		'/userprofile' => [
			'name' => '@userprofile/admin',
			'controller' => [
				'Bixie\\Userprofile\\Controller\\UserprofileController',
				'Bixie\\Userprofile\\Controller\\FieldController'
			]
		],
		'/api/userprofile/field' => [
			'name' => '@site/api/field',
			'controller' => 'Bixie\\Userprofile\\Controller\\FieldApiController'
		],
		'/api/userprofile/profile' => [
			'name' => '@site/api/profile',
			'controller' => 'Bixie\\Userprofile\\Controller\\ProfileApiController'
		]

	],

	'fieldtypes' => 'fieldtypes',

	'resources' => [

		'bixie/userprofile:' => ''

	],

	'menu' => [

		'userprofile' => [
			'label' => 'Userprofile',
			'icon' => 'packages/bixie/userprofile/icon.svg',
			'url' => '@userprofile/admin',
			'active' => '@userprofile(/*)'
		],

		'userprofile: fields' => [
			'label' => 'Fields',
			'parent' => 'userprofile',
			'url' => '@userprofile/admin',
			'active' => '@userprofile/admin(/edit)?'
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
			if ($app->config('bixie/userprofile')->get('override_registration', true) && $request->attributes->get('_route') == '@user/registration') {
				$event->setResponse($app->redirect('@userprofile/registration'), [], 301);
			}
		},

		'view.scripts' => function ($event, $scripts) use ($app) {
			$scripts->register('userprofile-settings', 'bixie/userprofile:app/bundle/settings.js', '~extensions');
			$scripts->register('link-userprofile', 'bixie/userprofile:app/bundle/link-userprofile.js', '~panel-link');
			$scripts->register('user-section-userprofile', 'bixie/userprofile:app/bundle/user-section-userprofile.js', ['~user-edit', 'bixie-fieldtypes']);
		},

		'view.data' => function ($event, $data) use ($app) {
			$route = $app->request()->attributes->get('_route');
			if (strpos($route, '@userprofile') === 0 || $route == '@user/edit') {
				$data->add('$fieldtypes', [
					'ajax_url' => 'api/userprofile/profile/ajax'
				]);
			}
			//load profile
			if (in_array($route, ['@userprofile', '@userprofile/registration', '@user/edit'])) {
				$self = $app->user();
				$edit_id = $app->request()->get('id');
				if ($route == '@user/edit') { //blank user when admin creates new user
					$user = $edit_id ? \Pagekit\User\Model\User::find($edit_id) : \Pagekit\User\Model\User::create();
				} else {
					$user = $self;
				}
				if ($self->hasAccess('user: manage users') || $user->id == $self->id) {
					$data->add('$userprofile', [
						'fields' => array_values(\Bixie\Userprofile\Model\Field::getProfileFields()),
						'profilevalues' => $app->module('bixie/userprofile')->getProfile($user),
					]);
				}
			}
		},

		'view.styles' => function ($event, $styles) use ($app) {
			$route = $app->request()->attributes->get('_route');
			if (strpos($route, '@userprofile') === 0 || in_array($route, ['@user/edit'])) {
				foreach ($app->module('bixie/userprofile')->getFieldTypes() as $type) {
					$type->addStyles($styles);
				}
			}
		},

		'console.init' => function ($event, $console) {

			$console->add(new Bixie\Userprofile\Console\Commands\TranslateCommand());

		}

	]

];
