<?php

namespace Bixie\Userprofile\Event;

use Pagekit\Application as App;
use Pagekit\Site\Model\Node;
use Pagekit\Event\EventSubscriberInterface;
use Bixie\Userprofile\UrlResolver;

class RouteListener implements EventSubscriberInterface {

    protected $nodes = [];
	/**
	 * Adds cache breaker to router.
     * Sets profiles routes
	 */
	public function onAppRequest () {
		App::router()->setOption('userprofile.profilelink', '{slug}');

        $this->nodes = Node::query()->where("link LIKE '@userprofile/profiles/%'")->get();

        foreach ($this->nodes as $node) {
            App::routes()->add([
                'name' => '@userprofile/profiles/' . $node->slug,
                'controller' => 'Bixie\\Userprofile\\Controller\\ProfilesController::indexAction',
                'label' => $node->title,
                'defaults' => [
                    '_node' => $node->id,
                    'roles' => $node->get('show_roles')
                ],
                'path' => $node->path,
            ]);
            App::routes()->add([
                'name' => '@userprofile/profiles/' . $node->slug . '/page',
                'controller' => 'Bixie\\Userprofile\\Controller\\ProfilesController::indexAction',
                'label' => $node->title,
                'defaults' => [
                    '_node' => $node->id,
                    'roles' => $node->get('show_roles')
                ],
                'path' => $node->path . '/page/{page}',
            ]);
            App::routes()->add([
                'name' => '@userprofile/profiles/' . $node->slug . '/id',
                'controller' => 'Bixie\\Userprofile\\Controller\\ProfilesController::detailsAction',
                'label' => __('Details'),
                'defaults' => [
                    '_node' => $node->id,
                ],
                'path' => $node->path . '/{slug}',
            ]);
        }

    }

	/**
	 * Registers permalink route alias.
	 */
	public function onConfigureRoute ($event, $route) {
		if ($route->getName() == '@userprofile/profiles/id') {
			App::routes()->alias(dirname($route->getPath()) . '/{slug}', '@userprofile/profiles/id', ['_resolver' => 'Bixie\Userprofile\UrlResolver']);
		}

        $name = $route->getName();
        foreach ($this->nodes as $node) {
            if ($name == "@userprofile/profiles/{$node->slug}/id") {
                App::routes()->alias(dirname($route->getPath()) . '/{slug}', "@userprofile/profiles/{$node->slug}/id", ['_resolver' => 'Bixie\Userprofile\UrlResolver']);

            }
		}
	}

	/**
	 * Clears resolver cache.
	 */
	public function clearCache () {
		App::cache()->delete(UrlResolver::CACHE_KEY);
	}

	/**
	 * {@inheritdoc}
	 */
	public function subscribe () {
		return [
			'request' => ['onAppRequest', 120],
			'route.configure' => 'onConfigureRoute',
			'model.user.saved' => 'clearCache',
			'model.user.deleted' => 'clearCache'
		];
	}
}
