<?php

namespace Pagekit\Userprofile\Model;

use Pagekit\System\Model\DataTrait;

/**
 * @Entity(tableClass="@userprofile_fields")
 */
class Field implements \JsonSerializable
{
    use DataTrait, FieldModelTrait;

    /** @Column(type="integer") @Id */
    protected $id;

    /** @Column(type="integer") */
    protected $priority = 0;

    /** @Column(type="string") */
    protected $type;

    /** @Column(type="string") */
    protected $label;

	/** @Column(type="json_array") */
    protected $options;

    /** @Column(type="json_array") */
    protected $data;

	/**
	 * @return integer
	 */
	public function getId () {
		return $this->id;
	}

	/**
	 * @param integer $id
	 */
	public function setId ($id) {
		$this->id = $id;
	}

	/**
	 * {@inheritdoc}
	 * @return mixed
	 */
	public function getPriority () {
		return $this->priority;
	}

	/**
	 * {@inheritdoc}
	 * @param mixed $priority
	 */
	public function setPriority ($priority) {
		$this->priority = $priority;
	}

	/**
	 * {@inheritdoc}
	 * @return string
	 */
	public function getType () {
		return $this->type;
	}

	/**
	 * {@inheritdoc}
	 * @param string $type
	 */
	public function setType ($type) {
		$this->type = $type;
	}

	/**
	 * {@inheritdoc}
	 * @return string
	 */
	public function getLabel () {
		return $this->label;
	}

	/**
	 * {@inheritdoc}
	 * @param string $label
	 */
	public function setLabel ($label) {
		$this->label = $label;
	}

	/**
	 * {@inheritdoc}
	 * @return mixed
	 */
	public function getOptions () {
		return $this->options ? : [];
	}

	/**
	 * {@inheritdoc}
	 * @param mixed $options
	 */
	public function setOptions ($options) {
		$this->options = $options;
	}

	/**
	 * {@inheritdoc}
	 */
	public function jsonSerialize()
	{
		$field = $this->toJson();

		$field['options'] = $this->getOptions();

		return $field;
	}

}
