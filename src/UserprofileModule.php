<?php

namespace Bixie\Userprofile;

use Bixie\Userprofile\Model\Profilevalue;
use Pagekit\Application as App;
use Pagekit\Module\Module;
use Bixie\Userprofile\Model\Field;
use Bixie\Userprofile\Type\TypeBase;
use Pagekit\User\Model\User;

class UserprofileModule extends Module {
	/**
	 * @var array
	 */
	protected $types;

	/**
	 * {@inheritdoc}
	 */
	public function main (App $app) {
		$app['field'] = function ($app) {
			if ($id = $app['request']->attributes->get('_field') and $field = Field::find($id)) {
				return $field;
			}

			return new Field;
		};
	}

	/**
	 * @param User|null $user
	 * @return array|bool
	 */
	public function getProfile (User $user = null) {
		if ($user = $user ?: App::user()) {
			$fields = Field::getProfileFields();
			$data = [];
			$profile = [];
			foreach (Profilevalue::getUserProfilevalues($user) as $profileValue) {
				$data[$profileValue->field_id] = $profileValue->getValue();
			}
			foreach ($fields as $profileField) {
				if (isset($data[$profileField->id])) {
					$profileField->set('value', $data[$profileField->id]);
					$profile[$profileField->label] = $profileField->prepareValue();
				}
			}
			return $profile;
		}
		return false;
	}

	/**
	 * @param  string $type
	 * @return TypeBase
	 */
	public function getType ($type) {
		$types = $this->getTypes();

		return isset($types[$type]) ? $types[$type] : null;
	}

	/**
	 * @return array
	 */
	public function getTypes () {
		//todo cache this
		if (!$this->types) {

			$this->types = [];
			$app = App::getInstance(); //available for type.php files
			$paths = [];

			foreach (App::module() as $module) {
				if ($module->get('userprofilefields')) {
					$paths = array_merge($paths, glob(sprintf('%s/%s/*/index.php', $module->path, $module->get('userprofilefields')), GLOB_NOSORT) ?: []);
				}
			}

			foreach ($paths as $p) {
				$package = array_merge([
					'id' => '',
					'class' => '\Bixie\Userprofile\Type\Type',
					'resource' => 'bixie/userprofile:app/bundle',
					'config' => [
						'hasOptions' => 0,
						'required' => 0,
						'multiple' => 0,
					],
					'dependancies' => [],
					'styles' => [],
					'getOptions' => '',
					'prepareValue' => '',
					'formatValue' => ''
				], include($p));
				$this->registerType($package);
			}

		}

		return $this->types;
	}

	/**
	 * Register a field type.
	 * @param array $package
	 */
	public function registerType ($package) {
		$this->types[$package['id']] = new $package['class']($package);
	}
}
