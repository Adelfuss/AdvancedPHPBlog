<?php

namespace models;

use core\DBDriver;
use core\Validator;

class PostModel extends BaseModel
{
	protected $schema = [
		'id' => [
			'primary' => true
		],

		'title' => [
			'type' => 'string',
			'length' => [50, 150],
			'not_blank' => true,
			'require' => true
		],

		'preview' => [
			'type' => 'string',
			'length' => 250
		],

		'text' => [
			'type' => 'string',
			'length' => 'big',
			'require' => true,
			'not_blank' => true,
			'type' => 'integer',
		]
	];

	public function __construct(DBDriver $db, Validator $validator)
	{
		parent::__construct($db, $validator, 'posts');
		$this->validator->setRules($this->schema);
	}
}