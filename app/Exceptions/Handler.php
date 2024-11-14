<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'error' => 'Unauthorized. Please login to access this resource.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'message' => 'Method not allowed. Please check the request method and try again.'
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof RouteNotFoundException) {
            return response()->json([
                'message' => 'Unauthorized. Please login to access this resource.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'message' => 'Unauthorized. Please login to access this resource.'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
