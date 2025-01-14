<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ModelNotFoundException extends Exception
{
    public function __construct(string $message = "Item not found", int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
