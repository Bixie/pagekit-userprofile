<?php

namespace  Bixie\Userprofile;

use Pagekit\Application as App;
use Pagekit\Routing\ParamsResolverInterface;
use Pagekit\User\Model\User;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class UrlResolver implements ParamsResolverInterface
{
    const CACHE_KEY = 'userprofile.routing';

    /**
     * @var bool
     */
    protected $cacheDirty = false;

    /**
     * @var array
     */
    protected $cacheEntries;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->cacheEntries = App::cache()->fetch(self::CACHE_KEY) ?: [];
    }

    /**
     * {@inheritdoc}
     */
    public function match(array $parameters = [])
    {
        if (isset($parameters['id'])) {
            return $parameters;
        }

        if (!isset($parameters['slug'])) {
            App::abort(404, 'Userprofile not found.');
        }
		$slug_key = App::module('bixie/userprofile')->config('slug_key', 'username');
        $slug = $parameters['slug'];

        $id = false;
        foreach ($this->cacheEntries as $entry) {
            if ($entry[$slug_key] === $slug) {
                $id = $entry['id'];
            }
        }

        if (!$id) {

            switch ($slug_key) {
				case 'id':
					$user = User::find($slug);
					break;
				case 'name':
					$user = User::where(['name' => $slug])->first();
            		break;
            	case 'username':
					$user = User::findByUsername($slug);
            		break;
            	default:
					$user = false;
            		break;
            }
			if (!$user) {
				App::abort(404, 'Userprofile not found.');
			}

            $this->addCache($user);
            $id = $user->id;
        }

        $parameters['id'] = $id;
        return $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(array $parameters = [])
    {
        $id = $parameters['id'];
		$slug_key = App::module('bixie/userprofile')->config('slug_key', 'username');

        if (!isset($this->cacheEntries[$id])) {

            if (!$user = App::auth()->getUserProvider()->find((int) $id)) {
                throw new RouteNotFoundException('Userprofile not found!');
            }

            $this->addCache($user);
        }

        $meta = $this->cacheEntries[$id];

        $parameters['slug'] = $meta[$slug_key];

        unset($parameters['id']);
        return $parameters;
    }

    public function __destruct()
    {
        if ($this->cacheDirty) {
            App::cache()->save(self::CACHE_KEY, $this->cacheEntries);
        }
    }

    protected function addCache($user)
    {
        $this->cacheEntries[$user->id] = [
            'id'     => $user->id,
            'username'   => App::filter($user->username, 'slugify'),
            'name'   => App::filter($user->name, 'slugify')
        ];

        $this->cacheDirty = true;
    }
}
