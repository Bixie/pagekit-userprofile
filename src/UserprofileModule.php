<?php

namespace Bixie\Userprofile;

use Bixie\Userprofile\Event\RouteListener;
use Bixie\Userprofile\Event\UserListener;
use Pagekit\Application as App;
use Pagekit\Module\Module;
use Bixie\Userprofile\Model\Profilevalue;
use Bixie\Userprofile\Model\Field;
use Pagekit\User\Model\User;

class UserprofileModule extends Module {
    /**
     * Bixie Framework Module version
     */
    const REQUIRED_FRAMEWORK_VERSION = '0.1.6';
	/**
	 * @var \Bixie\PkFramework\FrameworkModule
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

		$app->on('boot', function () use ($app) {
			$this->framework = $app->module('bixie/pk-framework');
			$app->subscribe(
				new RouteListener(),
				new UserListener()
			);
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
        if (!$this->framework) {
            return $profile;
        }
		if (($user = $user ?: App::user()) and $user->id > 0) {
			$profileValues = Profilevalue::getUserProfilevalues($user);
		}
		foreach (Field::getProfileFields($checkAccess) as $field) {
			$fieldValue = isset($profileValues[$field->id]) ? $profileValues[$field->id] : Profilevalue::create([
				'field_id' => $field->id,
				'user_id' => $user->id,
				'multiple' => $field->get('multiple') == 1 ? 1 : 0,
				'data' => $field->get('data')
			])->setField($field)->setValue($field->get('value'));
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
	 * @return \Bixie\PkFramework\FieldType\FieldTypeBase
	 */
	public function getFieldType ($type) {
		$fieldTypes = $this->getFieldTypes();

		return isset($fieldTypes[$type]) ? $fieldTypes[$type] : null;
	}

	/**
	 * @return array
	 */
	public function getFieldTypes () {
        if (!$this->framework) {
            return [];
        }
		if (!$this->fieldTypes) {
			$this->fieldTypes = $this->framework->getFieldTypes('bixie/userprofile');
		}

		return $this->fieldTypes;
	}

    /**
     * @return bool|string
     */
    public function checkFramework () {
        if (!$package = App::package('bixie/pk-framework')) {
            return __('Please install the Bixie Framework.');
        }
        if (!$module = App::module('bixie/pk-framework')) {
            return __('Please enable the Bixie Framework.');
        }
        if (version_compare(self::REQUIRED_FRAMEWORK_VERSION, $package->get('version')) == 1) {
            return __('Please update the Bixie Framework to version %version%.', ['%version%' => self::REQUIRED_FRAMEWORK_VERSION]);
        }
        return true;
    }

}
