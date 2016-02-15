<?php

namespace Bixie\Userprofile;

use Bixie\Framework\FieldValue\FieldValue;
use Pagekit\Application as App;
use Pagekit\Module\Module;
use Bixie\Userprofile\Model\Profilevalue;
//use Doctrine\DBAL\Schema\Comparator;
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
	 * @return array|bool
	 */
	public function getProfile (User $user = null) {
		if ($user = $user ?: App::user()) {
			$profileValues = Profilevalue::getUserProfilevalues($user);
			$profile = [];
			foreach (Field::getProfileFields() as $field) {
				$value = isset($profileValues[$field->id]) ? $profileValues[$field->id]->value : [];
				$id = isset($profileValues[$field->id]) ? $profileValues[$field->id]->id : 0;
				//convert single value to string
				if ($field->getFieldType()['multiple'] !== 1 && is_array($value)) {
					$value = reset($value) ?: '';
				}
				$profile[$field->slug] = (new FieldValue($field, compact('id', 'value')))->toFormattedArray();
			}
			return $profile;
		}
		return false;
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
