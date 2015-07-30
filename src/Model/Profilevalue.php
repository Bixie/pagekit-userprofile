<?php

namespace Pagekit\Userprofile\Model;

use Pagekit\System\Model\DataTrait;

/**
 * @Entity(tableClass="@userprofile_values")
 */
class Profilevalue implements \JsonSerializable
{
    use DataTrait, ProfilevalueModelTrait;

    /** @Column(type="integer") @Id */
    protected $id = 0;

	/** @Column(type="integer") */
	protected $user_id = 0;

	/** @Column(type="integer") */
	protected $field_id = 0;

	/** @Column(type="integer") */
	protected $multiple = 0;

	/** @Column(type="simple_array") */
    protected $value = '';

	/**
	 * @return integer
	 * {@inheritdoc}
	 */
	public function getId () {
		return $this->id;
	}

	/**
	 * {@inheritdoc}
	 * @param integer $id
	 */
	public function setId ($id) {
		$this->id = $id;
	}

	/**
	 * @return integer
	 */
	public function getUserId () {
		return $this->user_id;
	}

	/**
	 * {@inheritdoc}
	 * @param integer $user_id
	 */
	public function setUserId ($user_id) {
		$this->user_id = $user_id;
	}

	/**
	 * {@inheritdoc}
	 * @return integer
	 */
	public function getFieldId () {
		return $this->field_id;
	}

	/**
	 * {@inheritdoc}
	 * @param integer $field_id
	 */
	public function setFieldId ($field_id) {
		$this->field_id = $field_id;
	}

	/**
	 * {@inheritdoc}
	 * @return integer
	 */
	public function getMultiple () {
		return $this->multiple;
	}

	/**
	 * {@inheritdoc}
	 * @param integer $multiple
	 */
	public function setMultiple ($multiple) {
		$this->multiple = $multiple;
	}

	/**
	 * {@inheritdoc}
	 * @return mixed
	 */
	public function getValue () {
		if ($this->multiple) {
			return $this->value;
		} else {
			return $this->value ? $this->value[0] : '';
		}
	}

	/**
	 * weekend quiz.... why is this tournary not the same as function above????
	 */
	public function getValueWrong () {
		return $this->multiple ? $this->value : $this->value ? $this->value[0] : '';
	}

	/**
	 * {@inheritdoc}
	 * @param mixed $value
	 */
	public function setValue ($value) {
		$this->value = $this->multiple ? $value : [$value];
	}

	/**
	 * {@inheritdoc}
	 */
	public function jsonSerialize()
	{
		$field = $this->toJson();
		//$val = $this->getValueWrong(); //only returns first el of array as str form multiple???
		$field['value'] = $this->getValue();

		return $field;
	}

}
