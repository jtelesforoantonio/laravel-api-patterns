<?php

namespace App\Exceptions;

use App\Traits\ApiResponses;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponses;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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

    /**
     * {@inheritDoc}
     */
    public function render($request, Throwable $exception): Response
    {
        $response = parent::render($request, $exception);
        if ($exception instanceof ValidationException) {
            return $response;
        } else {
            $message = $response->getData()->message;

            return $this->errorResponse([], $message, $response->getStatusCode());
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return $this->errorResponse($exception->validator->errors()->all(), 'Invalid data.', $exception->status);
    }
}