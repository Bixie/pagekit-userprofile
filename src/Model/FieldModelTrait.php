<?php

namespace Pagekit\Userprofile\Model;

use Pagekit\Application as App;
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
		if (!$field->id) {
			$field->priority = self::getConnection()->fetchColumn('SELECT MAX(priority) + 1 FROM @userprofile_fields');
		}
	}
}
