<?php

namespace Pagekit\Userprofile\Controller;

use Pagekit\Application as App;
use Pagekit\Application\Exception;
use Pagekit\User\Model\User;
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
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail()
                ]
            ]
        ];
    }

    /**
     * @Request({"user": "array"}, csrf=true)
     */
    public function saveAction($data)
    {
        $user = App::user();

        if (!$user->isAuthenticated()) {
            App::abort(404);
        }

        try {

            $user = User::find($user->getId());

            if ($password = @$data['password_new']) {

                if (!App::auth()->getUserProvider()->validateCredentials($user, ['password' => @$data['password_old']])) {
                    throw new Exception(__('Invalid Password.'));
                }

                if (trim($password) != $password || strlen($password) < 3) {
                    throw new Exception(__('Invalid Password.'));
                }

                $user->setPassword(App::get('auth.password')->hash($password));
            }

            if (@$data['email'] != $user->getEmail()) {
                $user->set('verified', false);
            }

            $user->setName(@$data['name']);
            $user->setEmail(@$data['email']);

            $user->validate();
            $user->save();

            return ['message' => 'success'];

        } catch (Exception $e) {
            App::abort(400, $e->getMessage());
        }
    }
}
