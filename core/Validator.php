<?php

namespace core;

class Validator
{
    public $clean = [];
    public $errors = [];
    public $success = false;
    private $rules;

    public function execute(array $fields)
    {
        if (!$this->rules) {
            // ошибка
        }

        foreach ($this->rules as $name => $rules) {
            if (!isset($fields[$name]) && isset($rules['require'])) {
                $this->errors[$name][] = sprintf('Field %s is require!', $name);
            }

            if (!isset($fields[$name]) && (!isset($rules['require']) || !$rulesp['require'])) {
                continue;
            }

            if (isset($rules['type'])) {
                if ($rules['type'] === 'string') {
                    $fields[$name] = trim(htmlspecialchars($fields[$name]));
                } elseif ($rules['type'] === 'integer') {
                    if (!is_numeric($fields[$name])) {
                        $this->errors[$name][] = sprintf('');
                    }
                }
            }

            if (empty($this->errors[$name])) {
                $this->clean[$name] = $fields[$name];
            }
        }
    }

    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }
}