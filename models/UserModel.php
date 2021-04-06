<?php

namespace models;

use core\DBDriver;
use core\Validator;

class UserModel extends BaseModel
{
	protected $schema = [
		'id' => [
			'primary' => true
		],

		'login' => [
			'type' => 'string',
			'length' => [3, 50],
			'not_blank' => true,
			'require' => true
		],

		'password' => [
			'type' => 'string',
			'length' => [8, 50],
			'not_blank' => true,
			'require' => true
		],
	];

	public function __construct(DBDriver $db, Validator $validator)
	{
		parent::__construct($db, $validator, 'users');
		$this->validator->setRules($this->schema);
	}

	public function signUp(array $fields)
	{
		$this->validator->execute($fields);

		if (!$this->validator->success) {
			// throw new exception
		}

		return $this->add([
			'login' => $this->validator->clean['login'],
			'password' => $this->getHash($this->validator->clean['password'])
		]);
	}

	public function getByLogin($login)
	{
		$sql = "SELECT * FROM {$this->table} WHERE login = :login";
		return $this->db->select($sql, ['login' => $login], DBDriver::FETCH_ONE);
	}

	public function getHash($password)
	{
		return md5($password . 'JJJfdkkgfj0058__547383');
	}
}