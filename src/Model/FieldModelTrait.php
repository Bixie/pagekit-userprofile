<?php

namespace Pagekit\Userprofile\Model;

use Pagekit\Database\ORM\ModelTrait;

trait FieldModelTrait
{
    use ModelTrait;

    /**
     * @Saving
     */
    public static function saving($event, Field $field)
    {
        if (!$field->getId()) {
            $field->setPriority(self::getConnection()->fetchColumn('SELECT MAX(priority) + 1 FROM @userprofile_fields'));
        }
    }
}
