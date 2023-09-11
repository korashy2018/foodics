<?php

namespace App\Exceptions;

use App\Exceptions\ApiHandlers\NotFoundModelExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
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

    public function render($request, Throwable $exception): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response|RedirectResponse|null
    {
        return match (get_class($exception)) {
            ModelNotFoundException::class => (new NotFoundModelExceptionHandler())($request, $exception),
            default => parent::render($request, $exception),
        };

    }
}
