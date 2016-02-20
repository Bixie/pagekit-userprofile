<?php

namespace Bixie\Userprofile\Controller;

use Pagekit\Application as App;
use Pagekit\Kernel\Exception\NotFoundException;
use Bixie\Userprofile\Model\Field;
use Pagekit\User\Model\Role;

/**
 * @Access("site: manage site")
 */
class FieldController {

	/**
	 * @Route("/edit")
	 * @Request({"id"})
	 * @Access("site: manage site", admin=true)
	 */
	public function editAction ($id = '') {
		/** @var \Bixie\Userprofile\UserprofileModule $userprofile */
		$userprofile = App::module('bixie/userprofile');

		if (is_numeric($id)) {
			$field = Field::find($id);
		} else {
			$field = Field::create();
			$field->setFieldType($id);
			$field->set('value', []);
			$field->set('data', []);
		}

		if (!$field) {
			throw new NotFoundException(__('Field not found.'));
		}

		if (!$type = $userprofile->getFieldType($field->type)) {
			throw new NotFoundException(__('Type not found.'));
		}
		$fixedFields = ['multiple', 'required', 'controls', 'repeatable'];
		if (!$field->id) {
			foreach ($type->getConfig() as $key => $value) {
				if (!in_array($key, $fixedFields)) $field->set($key, $value);
			}
		}
		//check fixed value
		foreach ($fixedFields as $key) {
			if (!isset($type[$key])) $type[$key] = 0;
			if ($type[$key] != -1) {
				$field->set($key, $type[$key]);
			}
		}

		return [
			'$view' => [
				'title' => __('Field'),
				'name' => 'bixie/userprofile/admin/edit.php'
			],
			'$data' => [
				'field' => $field,
				'type' => $type,
				'roles' => array_values(Role::findAll())

			]
		];
	}

}
