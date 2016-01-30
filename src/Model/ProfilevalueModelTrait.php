<?php

namespace Bixie\Userprofile\Model;

use Pagekit\Database\ORM\ModelTrait;
use Pagekit\User\Model\User;

trait ProfilevalueModelTrait {
	use ModelTrait;

	/**
	 * @param \Pagekit\User\Model\User $user
	 * @return array
	 */
	public static function getUserProfilevalues (User $user) {
		$query = self::where(['user_id' => $user->id]);
		$profileValues = [];
		foreach ($query->get() as $profileValue) {
			$profileValues[$profileValue->field_id] = $profileValue;
		}
		return $profileValues;
	}

}
