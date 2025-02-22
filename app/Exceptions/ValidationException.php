<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ValidationException extends Exception
{
    protected Validator $validator;

    public function __construct(Validator $validator)
    {
        parent::__construct("Validation failed", Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->validator = $validator;
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'errors'  => $this->validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
