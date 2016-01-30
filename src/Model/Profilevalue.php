<?php

namespace Bixie\Userprofile\Model;

/**
 * @Entity(tableClass="@userprofile_value")
 */
class Profilevalue implements \JsonSerializable {

	use ProfilevalueModelTrait;

	/** @Column(type="integer") @Id */
	public $id = 0;

	/** @Column(type="integer") */
	public $user_id = 0;

	/** @Column(type="integer") */
	public $field_id = 0;

	/** @Column(type="integer") */
	public $multiple = 0;

	/** @Column(type="simple_array") */
	public $value = '';

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
	public function jsonSerialize () {
		$field = $this->toArray();
		//$val = $this->getValueWrong(); //only returns first el of array as str form multiple???
		$field['value'] = $this->getValue();

		return $field;
	}

}
