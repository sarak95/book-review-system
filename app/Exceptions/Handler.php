<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $exception, $request) {
            return $this->handleApiException($request, $exception);
        });
    }

    private function handleApiException($request, Throwable $exception): JsonResponse
    {
        if ($exception instanceof AuthenticationException) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], Response::HTTP_UNAUTHORIZED);
            }
        
            return redirect()->route('login'); 
        }
        

        if ($exception instanceof NotFoundException) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof UnauthorizedException) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof LaravelValidationException) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $exception->validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Resource not found.'], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof HttpResponseException) {
            return $exception->getResponse();
        }

        return response()->json([
            'message' => 'An unexpected error occurred.',
            'error'   => $exception->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
