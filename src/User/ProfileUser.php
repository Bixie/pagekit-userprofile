<?php

namespace Bixie\Userprofile\User;

use Bixie\Userprofile\Model\Profilevalue;
use Pagekit\Application as App;
use Pagekit\User\Model\User;
use Pagekit\Util\Arr;

class ProfileUser implements \JsonSerializable
{

	use ProfileUserTrait;

	/**
	 * @var integer
	 */
	public $id;

	/**
	 * @var User
	 */
	protected $user;

	/**
	 * @var array
	 */
	protected $data;

	/**
	 * @var Profilevalue[]
	 */
	protected $fieldValues;

	protected static $instances = [];
	/**
	 * @param User|null $user
	 * @return ProfileUser
	 */
	public static function load (User $user = null) {
		$user = $user ?: App::user();
		$class = get_called_class();
		if (!isset(self::$instances[$user->id]) || !(self::$instances[$user->id] instanceof $class)) {
			self::$instances[$user->id] = new $class($user);
		}
		return self::$instances[$user->id];
	}

	/**
	 * FreightheroUser constructor.
	 * @param $user
	 */
	public function __construct (User $user) {
		$this->id = $user->id ?: 0;
		$this->user = $user;
	}

	/**
	 * @return array
	 */
	public function getProfile () {
		if (!isset($this->data)) {
			$this->data = [];
			$this->fieldValues = App::module('bixie/userprofile')->getProfile($this->user, false, false);
			foreach ($this->fieldValues as $slug => $fieldValue) {
				$this->data[$slug] = $fieldValue->getValue(false);
			}
		}
		return $this->data;
	}

	/**
	 * @return array
	 */
	public function getProfileValues () {
		$this->getProfile();
		$data = [];
		foreach ($this->fieldValues as $slug => $fieldValue) {
			$data[$slug] = $fieldValue->toFormattedArray(['id' => $fieldValue->id]);
		}
		return $data;
	}

	/**
	 * @param array $profilevalues FormattedArray of profilevalues
	 */
	public function setProfileValues ($profilevalues) {
		$this->getProfile();
		foreach ($profilevalues as $field_value) {
			if (!isset($field_value['value']) || !isset($this->fieldValues[$field_value['slug']])) {
				continue;
			}
			$this->fieldValues[$field_value['slug']]->setValue($field_value['value'], @$field_value['data']);
		}
	}

	/**
	 * Gets a data value.
	 * @param  string $key
	 * @param  mixed  $default
	 * @return mixed
	 */
	public function get ($key, $default = null) {
		if (property_exists($this->user, $key)) {
			return $this->user->$key;
		}
		$this->getProfile();
		return Arr::get((array)$this->data, $key, $default);
	}

	/**
	 * Sets a data value.
	 * @param string $key
	 * @param mixed  $value
	 * @param array  $valuedata
	 */
	public function set ($key, $value, $valuedata = []) {
		$this->getProfile();
		Arr::set($this->data, $key, $value);
		if (isset($this->fieldValues[$key])) {
			$this->fieldValues[$key]->setValue($value, $valuedata);
		}
	}

	/**
	 * @param array $data raw profile values (na data possible)
	 */
	public function saveProfile ($data = []) {
		foreach ($data as $key => $value) {
			$this->set($key, $value);
		}
		foreach ($this->fieldValues as $fieldValue) {
			$fieldValue->save(['data' => $fieldValue->getValuedata()]);
		}
	}

	/**
	 * Proxy permissioncheck
	 * @param $permission
	 * @return bool
	 */
	public function hasAccess ($permission) {
		return $this->user->hasAccess($permission);
	}

	/**
	 * @param array $data
	 * @return array
	 */
	public function toArray ($data = []) {
		$this->getProfile();
		return array_merge($this->user->toArray($data, ['password', 'activation']), $this->data);
	}

	/**
	 * @return array
	 */
	function jsonSerialize () {
		return $this->toArray();
	}


}