<?php

namespace Pagekit\Userprofile\Controller;

use Pagekit\Application as App;
use Pagekit\Userprofile\Model\Field;
use Pagekit\Userprofile\Model\Profilevalue;

class ProfileController
{
    public function indexAction()
    {
        $user = App::user();
        $userprofile = App::module('userprofile');

        if (!$user->isAuthenticated()) {
            return App::redirect('@user/login', ['redirect' => App::url()->current()]);
        }

        return [
            '$view' => [
                'title' => __('Your Profile'),
                'name' => 'userprofile:views/profile.php'
            ],
            '$data' => [
                'config' => $userprofile->config('default'),
                'fields' => Field::getProfileFields(),
                'profilevalues' => Profilevalue::getUserProfilevalues($user),
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]
        ];
    }

}
