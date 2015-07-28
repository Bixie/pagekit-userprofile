<?php

return [

    'up' => function() use ($app) {

        $util = $app['db']->getUtility();

        if ($util->tableExists('@userprofile_fields') === false) {
            $util->createTable('@userprofile_fields', function($table) {
                $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
                $table->addColumn('priority', 'integer', ['default' => 0]);
                $table->addColumn('type', 'string', ['length' => 255]);
                $table->addColumn('label', 'string', ['length' => 255]);
                $table->addColumn('options', 'json_array', ['notnull' => false]);
                $table->addColumn('data', 'json_array', ['notnull' => false]);
                $table->setPrimaryKey(['id']);
            });
        }
    },

    'down' => function() use ($app) {

        $util = $app['db']->getUtility();

        if ($util->tableExists('@userprofile_fields')) {
            $util->dropTable('@userprofile_fields');
        }
    }

];
