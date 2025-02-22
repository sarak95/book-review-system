<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends Exception
{
    public function __construct($message = "Resource not found")
    {
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}
