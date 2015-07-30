<?php

namespace Pagekit\Userprofile\Model;

use Pagekit\Database\ORM\ModelTrait;

trait ProfilevalueModelTrait
{
    use ModelTrait;

    public static function getUserProfilevalues ($user) {
        $query = self::where(['user_id' => $user->id]);

        return array_values($query->get());

    }

}
