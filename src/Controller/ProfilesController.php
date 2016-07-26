<?php

namespace Bixie\Userprofile\Controller;

use Bixie\Userprofile\User\ProfileUser;
use Pagekit\Application as App;
use Pagekit\User\Model\User;

class ProfilesController {


	/**
	 * @Access("userprofile: view profiles")
	 * @Route("/")
	 * @Route("/page/{page}", name="page", requirements={"page" = "\d+"})
	 * @Request({"filter": "array", "page":"int", "limit":"int"})
	 */
	public function indexAction ($filter = [], $page = 1, $limit = 0) {
		$userprofile = App::module('bixie/userprofile');
		$query = User::query();
		$filter = array_merge(array_fill_keys(['search', 'order', 'access'], ''), $filter);
		extract($filter, EXTR_SKIP);

		$query->where(['status' => User::STATUS_ACTIVE, 'login IS NOT NULL']);

		if ($search) {
			$query->where(function ($query) use ($search) {
				$query->orWhere(
					['username LIKE :search', 'name LIKE :search', 'email LIKE :search'],
					['search' => "%{$search}%"]
				);
			});
		}

		if (preg_match('/^(username|name|email|registered|login)\s(asc|desc)$/i', $order, $match)) {
			$order = $match;
		} else {
			$order = [1 => 'username', 2 => 'asc'];
		}

		$default = $userprofile->config('list.profiles_per_page');
		$limit = min(max(0, $limit), $default) ?: $default;

		$count = $query->count('id');
		$total = ceil($count / $limit);
		$page = max(1, min($total, $page));

		$profileUsers = array_map(function ($user) {
			return ProfileUser::load($user);
		}, $query->offset(($page - 1) * $limit)->limit($limit)->orderBy($order[1], $order[2])->get());

		return [
			'$view' => [
				'title' => __('User Profiles'),
				'name' => 'bixie/userprofile/profiles.php'
			],
			'$data' => [],
			'config' => $userprofile->config(),
			'profileUsers' => $profileUsers,
			'total' => $total,
			'page' => $page
		];
	}

	/**
	 * @Access("userprofile: view profiles")
	 * @Route("/{id}", methods="GET", name="id")
	 * @Request({"id": "int"})
	 */
	public function detailsAction ($id) {
		if (!$user = App::auth()->getUserProvider()->find((int) $id) or !$profileUser = ProfileUser::load($user)) {

			App::abort(404, __('User not found.'));

		}

		return [
			'$view' => [
				'title' => __('User Profile'),
				'name' => 'bixie/userprofile/profile-details.php'
			],
			'$data' => [],
			'config' => App::module('bixie/userprofile')->config(),
			'profileUser' => $profileUser
		];
	}

}
