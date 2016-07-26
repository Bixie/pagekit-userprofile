<?php

namespace Bixie\Userprofile\Event;

use Pagekit\Application as App;
use Bixie\Freighthero\UrlResolver;
use Pagekit\Event\EventSubscriberInterface;

class RouteListener implements EventSubscriberInterface {
	/**
	 * Adds cache breaker to router.
	 */
	public function onAppRequest () {
		App::router()->setOption('userprofile.profilelink', '{slug}');
	}

	/**
	 * Registers permalink route alias.
	 */
	public function onConfigureRoute ($event, $route) {
		if ($route->getName() == '@userprofile/profiles/id') {
			App::routes()->alias(dirname($route->getPath()) . '/{slug}', '@userprofile/profiles/id', ['_resolver' => 'Bixie\Userprofile\UrlResolver']);
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
