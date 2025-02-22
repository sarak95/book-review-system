<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends Exception
{
    public function __construct($message = "Unauthorized access")
    {
        parent::__construct($message, Response::HTTP_FORBIDDEN);
    }
}
