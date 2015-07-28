<?php

namespace Pagekit\Userprofile\Controller;

use Pagekit\Application as App;
use Pagekit\Config\Config;
use Pagekit\Kernel\Exception\ConflictException;
use Pagekit\Userprofile\Model\Field;

/**
 * @Access("site: manage site")
 */
class FieldController
{
    /**
     * @var Config
     */
    protected $config;

    public function __construct()
    {
        $this->config = App::config('userprofile');
    }

    /**
     * @Route("/", methods="GET")
     */
    public function indexAction()
    {
        $query = Field::query();

        return array_values($query->get());
    }

    /**
     * @Route("/", methods="POST")
     * @Route("/{id}", methods="POST", requirements={"id"="\d+"})
     * @Request({"field": "array", "id": "int"}, csrf=true)
     */
    public function saveAction($data, $id = 0)
    {
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
    public function updateOrderAction($fields = [])
    {
        foreach ($fields as $data) {
            if ($field = Field::find($data['id'])) {

                $field->setPriority($data['order']);

                $field->save();
            }
        }

        return ['message' => 'success'];
    }

    /**
     * @Route("/{id}", methods="DELETE")
     * @Request({"id"}, csrf=true)
     */
    public function deleteAction($id)
    {
        App::config('system/site')->remove('menus.'.$id);
        Field::where(['menu = :id'], [':id' => $id])->update(['menu' => 'trash', 'status' => 0]);

        return ['message' => 'success'];
    }

    protected function slugify($slug)
    {
        $slug = preg_replace('/\xE3\x80\x80/', ' ', $slug);
        $slug = str_replace('-', ' ', $slug);
        $slug = preg_replace('#[:\#\*"@+=;!><&\.%()\]\/\'\\\\|\[]#', "\x20", $slug);
        $slug = str_replace('?', '', $slug);
        $slug = trim(mb_strtolower($slug, 'UTF-8'));
        $slug = preg_replace('#\x20+#', '-', $slug);

        return $slug;
    }
}
