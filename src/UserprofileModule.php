<?php

namespace Bixie\Userprofile;

use Bixie\Framework\FieldValue\FieldValue;
use Pagekit\Application as App;
use Pagekit\Module\Module;
use Bixie\Userprofile\Model\Profilevalue;
use Bixie\Userprofile\Model\Field;
use Pagekit\User\Model\User;

class UserprofileModule extends Module {
	/**
	 * @var \Bixie\Framework\FrameworkModule
	 */
	protected $framework;
	/**
	 * @var array
	 */
	protected $fieldTypes;

	/**
	 * {@inheritdoc}
	 */
	public function main (App $app) {
		if (!in_array('bixie/framework', App::system()->config('extensions'))) {
			throw new \RuntimeException('Bixie Framework required for Userprofile');
		}


		$app->on('boot', function () use ($app) {
			$this->framework = App::module('bixie/framework');
		});

	}

	/**
	 * @param User|null $user
	 * @param bool      $asArray
	 * @param bool      $checkAccess
	 * @return array|bool
	 */
	public function getProfile (User $user = null, $asArray = true, $checkAccess = true) {
		$profile = [];
		if (($user = $user ?: App::user()) and $user->id > 0) {
			$profileValues = Profilevalue::getUserProfilevalues($user);
		}
		foreach (Field::getProfileFields($checkAccess) as $field) {
			$fieldValue = isset($profileValues[$field->id]) ? $profileValues[$field->id] : Profilevalue::create([
				'data' => $field->get('data')
			])->setValue($field->get('value'));
			if ($asArray) {
				$profile[$field->slug] = $fieldValue->setField($field)->toFormattedArray(['id' => $fieldValue->id]);
			} else {
				$profile[$field->slug] = $fieldValue->setField($field);
			}
		}
		return $profile;
	}

	/**
	 * @param  string $type
	 * @return \Bixie\Framework\FieldType\FieldTypeBase
	 */
	public function getFieldType ($type) {
		$fieldTypes = $this->getFieldTypes();

		return isset($fieldTypes[$type]) ? $fieldTypes[$type] : null;
	}

	/**
	 * @return array
	 */
	public function getFieldTypes () {
		if (!$this->fieldTypes) {
			$this->fieldTypes = $this->framework->getFieldTypes('bixie/userprofile');
		}

		return $this->fieldTypes;
	}

}
