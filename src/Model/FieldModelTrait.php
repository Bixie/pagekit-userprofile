<?php

namespace Bixie\Userprofile\Model;

use Pagekit\Application as App;
use Pagekit\Application\Exception;
use Pagekit\Database\ORM\ModelTrait;

trait FieldModelTrait {
	use ModelTrait;

	public static function getProfileFields ($checkAccess = true) {
		$user = App::user();
		$data = [];
		foreach (self::query()->get() as $field) {
			if ($checkAccess === false || $field->hasAccess($user)) {
				$data[$field->id] = $field;
			}
		}
		return $data;

	}

	/**
	 * @Saving
	 */
	public static function saving ($event, Field $field) {
		$userprofile = App::module('bixie/userprofile');

		if (!$type = $userprofile->getFieldType($field->type)) {
			throw new Exception(__('Field type not found.'));
		}

		foreach (['multiple', 'required'] as $key) {
			if ($type[$key] != -1) { //check fixed value
				if ($type[$key] != $field->get($key)) {
					throw new Exception(__('Invalid value for ' . $key . ' option.'));
				}
			}
		}

		//slug
		$i = 2;
		$id = $field->id;

		if (!$field->slug) {
			$field->slug = $field->label;
		}

		while (self::where(['slug = ?'], [$field->slug])->where(function ($query) use ($id) {
			if ($id) $query->where('id <> ?', [$id]);
		})->first()) {
			$field->slug = preg_replace('/-\d+$/', '', $field->slug) . '-' . $i++;
		}

		if (!$field->id) {
			$next = self::getConnection()->fetchColumn('SELECT MAX(priority) + 1 FROM @userprofile_field');
			$field->priority = $next ? : 0;
		}
	}
}
