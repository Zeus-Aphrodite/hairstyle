<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ValidationException::class,
        ModelNotFoundException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->route() && \in_array('api', $request->route()->middleware())) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([], 404);
            }
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'validationErrors' => $exception->errors(),
                ], 422);
            }
            return response()->json([
                'errorMessage' => $exception->getMessage(),
            ], $exception->getCode() ?: 400);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (\in_array('admin', $exception->guards())) {
            return \redirect(\route('admin.login.form'));
        }
        return parent::unauthenticated($request, $exception);
    }
}
