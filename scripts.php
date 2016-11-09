<?php
use Doctrine\DBAL\Schema\Comparator;
use Bixie\Userprofile\Model\Field;

return [

    'install' => function ($app) {

		$util = $app['db']->getUtility();

		if ($util->tableExists('@userprofile_field') === false) {
			$util->createTable('@userprofile_field', function ($table) {
				$table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
				$table->addColumn('priority', 'integer', ['default' => 0]);
				$table->addColumn('type', 'string', ['length' => 255]);
				$table->addColumn('label', 'string', ['length' => 255]);
				$table->addColumn('slug', 'string', ['length' => 255]);
				$table->addColumn('options', 'json_array', ['notnull' => false]);
				$table->addColumn('roles', 'simple_array', ['notnull' => false]);
				$table->addColumn('data', 'json_array', ['notnull' => false]);
				$table->setPrimaryKey(['id']);
			});
		}

		if ($util->tableExists('@userprofile_value') === false) {
			$util->createTable('@userprofile_value', function ($table) {
				$table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
				$table->addColumn('user_id', 'integer', ['unsigned' => true, 'length' => 10]);
				$table->addColumn('field_id', 'integer', ['unsigned' => true, 'length' => 10]);
				$table->addColumn('multiple', 'smallint');
				$table->addColumn('value', 'json_array', ['notnull' => false]);
				$table->addColumn('data', 'json_array', ['notnull' => false]);
				$table->setPrimaryKey(['id']);
				$table->addIndex(['user_id'], 'USERPROFILE_VALUES_USERID');
			});
		}

    },

	'uninstall' => function ($app) {

		$util = $app['db']->getUtility();

		if ($util->tableExists('@userprofile_field')) {
			$util->dropTable('@userprofile_field');
		}
        if ($util->tableExists('@userprofile_value')) {
            $util->dropTable('@userprofile_value');
        }

		// remove the config
		$app['config']->remove('bixie/userprofile');

	},

	'updates' => [

		'1.2.0' => function ($app) {
			$util = $app['db']->getUtility();

			if ($util->tableExists('@userprofile_field')) {
				$table =  $util->listTableDetails('@userprofile_field');
				if (!$table->hasColumn('slug')) {
					$table->addColumn('slug', 'string', ['length' => 255]);
					$util->alterTable((new Comparator())->diffTable($util->listTableDetails('@userprofile_field'), $table));
					foreach (Field::findAll() as $field) {
						$field->save(['slug' => $app->filter($field->label, 'slugify')]);
					}
				}
			}
			if ($util->tableExists('@userprofile_value')) {
				$table =  $util->listTableDetails('@userprofile_value');
				if (!$table->hasColumn('data')) {
					$table->addColumn('data', 'json_array', ['notnull' => false]);
					$util->alterTable((new Comparator())->diffTable($util->listTableDetails('@userprofile_value'), $table));
				}
			}
		}

	]

];