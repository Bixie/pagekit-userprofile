<?php

namespace Pagekit\Userprofile\Model;

use Pagekit\Application as App;
use Pagekit\Application\Exception;
use Pagekit\Database\ORM\ModelTrait;

trait FieldModelTrait {
	use ModelTrait;

	public static function getProfileFields () {
		$user = App::user();
		$data = [];
		foreach (self::query()->get() as $field) {
			if ($field->hasAccess($user)) {
				$data[] = $field;
			}
		}
		return $data;

	}

	/**
	 * @Saving
	 */
	public static function saving ($event, Field $field) {
		$userprofile = App::module('userprofile');

		if (!$type = $userprofile->getType($field->type)) {
			throw new Exception(__('Field type not found.'));
		}

		foreach (['multiple', 'required'] as $key) {
			if ($type[$key] != -1) { //check fixed value
				if ($type[$key] != $field->get($key)) {
					throw new Exception(__('Invalid value for ' . $key . ' option.'));
				}
			}
		}

		if (!$field->id) {
			$next = self::getConnection()->fetchColumn('SELECT MAX(priority) + 1 FROM @userprofile_field');
			$field->priority = $next ? : 0;
		}
	}
}
