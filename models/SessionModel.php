<?php

namespace models;

use core\DBDriver;
use core\Validator;

class SessionModel extends BaseModel
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
		parent::__construct($db, $validator, 'sessions');
		$this->validator->setRules($this->schema);
	}

}