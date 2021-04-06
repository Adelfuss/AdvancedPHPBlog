<?php

namespace core;

class DBConnector
{
	private static $instance;

	public static function getConnect()
	{
		if (self::$instance === null) {
			self::$instance = self::getPDO();
		}

		return self::$instance;
	}

	private static function getPDO()
	{
		$opt = [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        	\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
		$dsn = sprintf('%s:host=%s;dbname=%s', 'mysql', 'localhost', 'phpshop');
		return new \PDO($dsn, 'root', '', $opt);
	}
}