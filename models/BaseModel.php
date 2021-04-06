<?php
namespace models;

use core\DBDriver;
use core\Validator;

abstract class BaseModel
{
    protected $db;
    protected $tables;
    protected $validator;

    public function __construct(DBDriver $db, Validator $validator, $table)
	{
		$this->db = $db;
		$this->table = $table;
		$this->validator = $validator;
	}

    public function getAll()
	{
		$sql = sprintf('SELECT * FROM %s', $this->table);
		return $this->db->select($sql);
	}

	public function getById($id)
	{
		$sql = sprintf('SELECT * FROM %s WHERE id = :id', $this->table);
		return $this->db->select($sql, ['id' => $id], DBDriver::FETCH_ONE);
	}

	public function add(array $params, $needValidation = true)
	{
		if ($needValidation) {
			$this->validator->execute($params);

			if (!$this->validator->success) {
				// обработать ошибку
				$this->validator->errors;
			}

			$params = $this->validator->clean;
		}

		return $this->db->insert($this->table, $params);
	}
}