<?php

namespace App\Exceptions;

use Exception;

class HashIdException extends Exception
{
    public function __construct(string $hash)
    {
        parent::__construct("The given hash $hash is invalid.");
    }
}
