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
		if (!isset(self::$instances[$user->id])) {
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

	public function getProfileValues () {
		$this->getProfile();
		$data = [];
		foreach ($this->fieldValues as $slug => $fieldValue) {
			$data[$slug] = $fieldValue->toFormattedArray(['id' => $fieldValue->id]);
		}
		return $data;
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
	 */
	public function set ($key, $value) {
		$this->getProfile();
		Arr::set($this->data, $key, $value);
		if (isset($this->fieldValues[$key])) {
			$this->fieldValues[$key]->setValue($value);
		}
	}

	/**
	 * @param array $data
	 */
	public function saveProfile ($data = []) {
		foreach ($data as $key => $value) {
			$this->set($key, $value);
		}
		foreach ($this->fieldValues as $fieldValue) {
			$fieldValue->save();
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