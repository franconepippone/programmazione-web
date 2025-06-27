<?php

class ValidationException extends Exception
{

    public array $details = [];

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null, array $details = [])
    {
        parent::__construct($message, $code, $previous);
        $this->details = $details;
    }
}
