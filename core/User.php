<?php

namespace core;

use models\UserModel;
use models\SessionModel;
use core\Request;

class User
{
	private $mUser;
	private $mSession;

	public function __construct(UserModel $mUser, SessionModel $mSession)
	{
		$this->mUser = $mUser;
		$this->mSession = $mSession;
	}

	public function signUp(array $fields)
	{
		if (!$this->comparePass($fields)) {
			return false;
		}

		$this->mUser->signUp($fields);
	}

	public function signIn(array $fields)
	{
		$user = $this->mUser->getByLogin($fields['login']);

		if (!$user) {
			// throw new UnathorizedException('User with login %s is not found');
		}

		$mathced = $this->mUser->getHash($fields['password']) === $user['password'];
		if (!$mathced) {
			// throw new UnathorizedException('User with login %s is not found');
		}

		if (isset($fieldsp['remember'])) {
			// ставим куку
		}

		// Открываем обе сессии;

		return true;
	}

	public function isAuth(Request $request)
	{
		$_SESSION['sid'] && $this->mSession->getBySid('sid') === true;

		// SELECT users.id as id, login, password FROM sessions JOIN users ON sessions.id_user = users.id WHERE sid = '1234567890'
		$user = $this->mUser->getBySid('sid');
	}

	private function comparePass($fields)
	{
		return $fields['password'] === $fields['password-reply'];
	}
}