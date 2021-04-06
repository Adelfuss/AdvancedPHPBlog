<?php

namespace Forms;

use core\Forms\Form;

class SignUp extends Form
{
    public function __construct()
    {
        $this->fields = [
            [
                'name' => 'login',
                'type' => 'text',
                'placeholder' => 'Enter your login',
                'class' => 'class-class'
            ],
            [
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'Введите пароль'
            ],
            [
                'name' => 'password-reply',
                'type' => 'password',
                'placeholder' => 'Повторите пароль'
            ],
            [
                'type' => 'submit',
                'value' => 'Тыкалка'
            ],
        ];

        $this->formName = 'sign-up';
        $this->method = 'POST';
    }
}