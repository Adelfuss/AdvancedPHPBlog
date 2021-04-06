<?php

namespace Core\Exception;

class ValidationException extends CoreException
{
    private $errors;

    public function __construct($message = 'validation exception', $code = 403, array $errors, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}