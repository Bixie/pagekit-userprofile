<?php

namespace Pagekit\Userprofile\Model;

use Pagekit\Database\ORM\ModelTrait;

trait FieldModelTrait
{
    use ModelTrait;

    public static function getProfileFields () {
        $query = self::query();

        return array_values($query->get());

    }

    /**
     * @Saving
     */
    public static function saving($event, Field $field)
    {
        if (!$field->id) {
            $field->setPriority(self::getConnection()->fetchColumn('SELECT MAX(priority) + 1 FROM @userprofile_fields'));
        }
    }
}
