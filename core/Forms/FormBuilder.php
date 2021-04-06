<?php

namespace core\Forms;

class FormBuilder
{
    public $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function method()
    {
        $method = $this->form->getMethod();

        if (null === $method) {
            $method = 'GET';
        }

        return sprintf('method="%s"', $method);
    }

    public function fields()
    {
        foreach ($this->form->getFields() as $field) {
            $attributes = [];

            $inputs[] = $this->input($field);
        }

        return $inputs;
    }

    public function sign()
    {
        $string = '';
        foreach ($this->form->getFields() as $field) {
            if (isset($field->name)) {
                $string = '/#@=@/' . $field->name;
            }
        }

        return md5($string);
    }

    public function input(array $attributes)
    {
        return sprintf('<input %s>', $this->buildAttributes($attributes));
    }

    public function inputSign()
    {
        return $this->input([
            'type' => 'hidden',
            'name' => 'sign',
            'value' => $this->sign()
        ]);
    }

    private function buildAttributes(array $attributes)
    {
        $arr = [];
        foreach($attributes as $attribute => $value) {
            $arr[] = sprintf('%s="%s"', $attribute, $value);
        }

        return implode(' ', $arr);
    }
}
