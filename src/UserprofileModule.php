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

//		$app->on('request', function () use ($app) {
//			$util = $app['db']->getUtility();
//			if ($util->tableExists('@userprofile_field')) {
//				$table =  $util->listTableDetails('@userprofile_field');
//				if (!$table->hasColumn('slug')) {
//					$table->addColumn('slug', 'string', ['length' => 255]);
//					$util->alterTable((new Comparator())->diffTable($util->listTableDetails('@userprofile_field'), $table));
//					foreach (Field::findAll() as $field) {
//						$field->save(['slug' => $app->filter($field->label, 'slugify')]);
//					}
//				}
//			}
//		});

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
