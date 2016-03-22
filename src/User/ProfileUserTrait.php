<?php

namespace Bixie\Userprofile\User;


use Pagekit\Database\Query\QueryBuilder;
use Pagekit\User\Model\User;

trait ProfileUserTrait {


	/**
	 * {@inheritdoc}
	 */
	public static function queryProfileValues ($condition, $exact = false) {
		/** @var QueryBuilder $query */
		$query = User::where(['status' => User::STATUS_ACTIVE]);
		$query->from('@system_user AS u')->select('u.*');
		$params = [];
		foreach ($condition as $slug => $search) {
			$slg = str_replace('-', '_', $slug);
			$query->leftJoin(sprintf('@userprofile_field AS pf_%s', $slg),
				sprintf('pf_%1$s.slug = :slug_%1$s', $slg))
				->leftJoin(sprintf('@userprofile_value AS pv_%s', $slg),
					sprintf('pv_%1$s.field_id = pf_%1$s.id AND pv_%1$s.user_id = u.id', $slg));
			if ($exact) {
				$query->where(sprintf('pv_%1$s.value = :search_%1$s', $slg));
			} else {
				$query->where(sprintf('pv_%1$s.value LIKE :search_%1$s', $slg));
				$search = "%$search%";
			}
			$params["slug_$slg"] = $slug;
			$params["search_$slg"] = $search;
		}
		$query->params($params);

		return $query;

	}


}