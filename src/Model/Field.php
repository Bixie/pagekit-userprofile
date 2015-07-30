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
    public $id;

    /** @Column(type="integer") */
    public $priority = 0;

    /** @Column(type="string") */
    public $type;

    /** @Column(type="string") */
    public $label;

	/** @Column(type="json_array") */
    protected $options;

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
		$field = $this->toArray();

		$field['options'] = $this->getOptions();

		return $field;
	}

}
