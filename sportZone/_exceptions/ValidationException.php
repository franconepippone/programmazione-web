<?php

class ValidationException extends Exception
{
    // You can add custom functionality if needed
    // For example, a property to store validation errors
    protected array $errors = [];

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null, array $errors = [])
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
