<?php

namespace Bixie\Userprofile\Controller;

use Pagekit\Application as App;
use Pagekit\Application\Exception;
use Bixie\Userprofile\Model\Field;
use Bixie\Userprofile\Model\Profilevalue;

/**
 * @Access("userprofile: manage settings")
 */
class FieldApiController {

	/**
	 * @Route("/", methods="GET")
	 */
	public function indexAction () {
		$query = Field::query();
		return array_values($query->get());
	}

	/**
	 * @Route("/", methods="POST")
	 * @Route("/{id}", methods="POST", requirements={"id"="\d+"})
	 * @Request({"field": "array", "id": "int"}, csrf=true)
	 */
	public function saveAction ($data, $id = 0) {

		if (!$field = Field::find($id)) {
			$field = Field::create(['data' => [
				'value' => [],
				'data' => [],
				'classSfx' => '',
				'help_text' => '',
				'help_show' => ''
			]]);
			unset($data['id']);
		}

		if (!$data['slug'] = App::filter($data['slug'] ?: $data['label'], 'slugify')) {
			App::abort(400, __('Invalid slug.'));
		}

		try {

			$field->save($data);

		} catch (Exception $e) {
			App::abort(400, $e->getMessage());
		}

		return ['message' => 'success', 'field' => $field];
	}

	/**
	 * @Route("/updateOrder", methods="POST")
	 * @Request({"fields": "array"}, csrf=true)
	 */
	public function updateOrderAction ($fields = []) {
		foreach ($fields as $data) {
			if ($field = Field::find($data['id'])) {

				$field->priority = $data['order'];

				$field->save();
			}
		}

		return ['message' => 'success'];
	}

	/**
	 * @Route("/{id}", methods="DELETE", requirements={"id"="\d+"})
	 * @Request({"id": "int"}, csrf=true)
	 */
	public function deleteAction ($id) {
		if ($field = Field::find($id)) {

			foreach (Profilevalue::where(['field_id = :id'], [':id' => $id])->get() as $profilevalue) {
				$profilevalue->delete();
			}

			$field->delete();
		}

		return ['message' => 'success'];
	}

	/**
	 * @Route("/bulk", methods="DELETE")
	 * @Request({"ids": "array"}, csrf=true)
	 */
	public function bulkDeleteAction ($ids = []) {
		foreach (array_filter($ids) as $id) {
			$this->deleteAction($id);
		}

		return ['message' => 'success'];
	}

}
