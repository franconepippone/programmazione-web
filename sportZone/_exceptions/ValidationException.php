<?php

class ValidationException extends Exception
{

    protected array $details = [];

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null, array $details = [])
    {
        parent::__construct($message, $code, $previous);
        $this->details = $details;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
