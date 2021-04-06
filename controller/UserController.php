<?php

namespace controller;

use core\User;
use models\UserModel;
use models\SessionModel;
use core\DBConnector;
use core\DBDriver;
use core\Validator;

class UserController extends BaseController
{
	public function signInAction()
	{
		$errors = [];
		$this->title .= '::Авторизация';

		if ($this->request->isPost()) {
			$mUser = new UserModel(
				new DBDriver(DBConnector::getConnect()),
				new Validator()
			);

			$mSession = new SessionModel(
				new DBDriver(DBConnector::getConnect()),
				new Validator()
			);

			$user = new User($mUser, $mSession);
			$user->signIn($this->request->post());
		}

		$this->content = $this->build(
			__DIR__ . '/../views/sign-in.html.php',
			[
				'errors' => $errors
			]
		);
	}

	public function signUpAction()
	{
		$errors = [];
		$this->title .= '::Регистрация';

		if ($this->request->isPost()) {
			$mUser = new UserModel(
				new DBDriver(DBConnector::getConnect()),
				new Validator()
			);

			$user = new User($mUser);

			try {
				$user->signUp($this->request->post());
				$this->redirect('/');
			} catch (\Exception $e) {
				$errors = $e->getErrors();
			}
		}

		$this->content = $this->build(
			__DIR__ . '/../views/sign-up.html.php',
			[
				'errors' => $errors
			]
		);
	}
}