<?php

namespace Pagekit\Userprofile\Controller;

use Pagekit\Application as App;
use Pagekit\Kernel\Exception\NotFoundException;
use Pagekit\Userprofile\Model\Field;
use Pagekit\User\Model\Role;

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

	/**
	 * @Route("/edit")
	 * @Request({"id"})
	 */
	public function editAction ($id = '') {
		$userprofile = App::module('userprofile');

		if (is_numeric($id)) {
			$field = Field::find($id);
		} else {
			$field = Field::create();
			$field->setType($id);
		}

		if (!$field) {
			throw new NotFoundException(__('Field not found.'));
		}

		if (!$type = $userprofile->getType($field->getType())) {
			throw new NotFoundException(__('Type not found.'));
		}

		return [
			'$view' => [
				'title' => __('Field'),
				'name' => 'userprofile:views/admin/edit.php'
			],
			'$data' => [
				'field' => $field,
				'type' => $type,
				'roles' => array_values(Role::findAll())

			]
		];
	}



}
