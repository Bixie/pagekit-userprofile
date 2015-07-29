<?php

namespace Pagekit\Userprofile\Controller;

use Pagekit\Application as App;

class SiteController
{
    /**
     * @Route("/")
     * @Route("/{name}", name="name")
     */
    public function indexAction($name = '')
    {
        $names = explode(',', $name ?: App::module('userprofile')->config('default'));

        return [
            '$view' => [
                'title' => __('Hello %name%', ['%name%' => $names[0]]),
                'name' => 'userprofile:views/index.php'
            ],
            'names' => $names
        ];
    }

    /**
     * @Route("/profile")
     * @Route("/profile/{username}", username="username")
     */
    public function profileAction($username = '') {
        $userprofile = App::module('userprofile');

        return [
            '$view' => [
                'title' => __('User profile'),
                'name' => 'userprofile:views/profile.php'
            ],
            '$data' => [
                'config' => App::module('userprofile')->config('default'),
                'types' => $userprofile->getTypes()
            ]
        ];

    }

    /**
     * @Route("/greet")
     * @Route("/greet/{name}", name="name")
     */
    public function greetAction($name = '')
    {
        $names = explode(',', $name ?: App::module('userprofile')->config('default'));

        return [
            '$view' => [
                'title' => __('Hello %name%', ['%name%' => $names[0]]),
                'name' => 'userprofile:views/index.php'
            ],
            'names' => $names
        ];
    }

    public function redirectAction()
    {
        return App::response()->redirect('@userprofile/greet', ['name' => 'Someone']);
    }

    public function jsonAction()
    {
        return ['message' => 'There is nothing here. Move along.'];
    }

    public function downloadAction()
    {
        return App::response()->download('extensions/userprofile/extension.svg');
    }

    function forbiddenAction()
    {
        App::abort(401, __('Permission denied.'));
    }
}
