<?php

namespace Pagekit\Userprofile\Controller;

use Pagekit\Application as App;
use Pagekit\Userprofile\Model\Field;

class FieldApiController {

	/**
	 * @Route("/", methods="GET")
	 */
	public function indexAction() {
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
			$field = Field::create();
			unset($data['id']);
		}

		$field->save($data);

		return ['message' => 'success', 'field' => $field];
	}

	/**
	 * @Route("/updateOrder", methods="POST")
	 * @Request({"fields": "array"}, csrf=true)
	 */
	public function updateOrderAction ($fields = []) {
		foreach ($fields as $data) {
			if ($field = Field::find($data['id'])) {

				$field->setPriority($data['order']);

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
