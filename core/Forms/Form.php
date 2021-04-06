<?php

namespace Core\Forms;

use Core\Request;

abstract class Form
{
    protected $formName;
    protected $action;
    protected $method;
    protected $fields;

    public function getName()
    {
        return $this->formName;
    }

    public function getAction()
    {
        return $this->action();
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getFields()
    {
        return new \ArrayIterator($this->fields);
    }

    public function handleRequest(Request $request)
    {
        $fields = [];
        $string = '';

        foreach($this->getFields() as $field)
        {
            if (!isset($field['name'])) {
                continue;
            }

            $name = $field['name'];

            if (null !== $request->post($name)) {
                $fields[$name] = $request->post($name);
            }
        }

        if (null !== $request->post('sign') && $this->getSign() !== $request->post('sign')) {
            die('Формы не совпадают!');
        }

        return $fields;
    }

    public function getSign()
    {
        $string = '';
        foreach ($this->getFields() as $field) {
            if (isset($field['name'])) {
                $string .= '/#@=@/' . $field['name'];
            }
        }

        return md5($string);
    }

    public function addErrors(array $errors)
    {
        foreach ($this->fields as $key => $field) {
            $name = $field['name'] ?? null;
            if (isset($errors[$name])) {
                $this->fields[$key]['errors'] = $errors[$name];
            }
        }
    }
}