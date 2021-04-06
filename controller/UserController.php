<?php

namespace Controller;

use Core\User;
use Models\UserModel;
use Models\SessionModel;
use Core\DBConnector;
use Core\DBDriver;
use Core\Validator\Validator;
use Forms\SignUp;
use Core\Forms\FormBuilder;
use Core\Exceptions\ValidationException;

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
        $this->title .= '->userReg();';

        $form = new SignUp();
        $formBuilder = new FormBuilder($form);

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

            try {
                $user->signUp($form->handleRequest($this->request));
                $this->redirect('/');
            } catch (ValidationException $e) {
                $form->addErrors($e->getErrors());
            }
        }

        $this->content = $this->build(
            __DIR__ . '/../views/sign-up.html.php',
            [
                'form' => $formBuilder
            ]
        );
    }
}