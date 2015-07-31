<?php

namespace Pagekit\Userprofile;

use Pagekit\Application as App;
use Pagekit\Module\Module;
use Pagekit\Userprofile\Model\Field;

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
	 * @param  string $type
	 * @return array
	 */
	public function getType ($type) {
		$types = $this->getTypes();

		return isset($types[$type]) ? $types[$type] : null;
	}

	/**
	 * @return array
	 */
	public function getTypes () {
		if (!$this->types) {

			$this->types = [];
			$paths = glob(App::locator()->get('userprofile:app/fields') . '/*', GLOB_NOSORT) ?: [];

			foreach ($paths as $p) {

				$this->registerType(basename($p, '.vue'));

			}

		}

		return $this->types;
	}

	/**
	 * Register a field type.
	 * @param string $type
	 */
	public function registerType ($type) {
		$this->types[$type] = ['id' => $type, 'label' => __($type)];
	}
}
