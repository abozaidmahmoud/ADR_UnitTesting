<?php

namespace App\App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * @param  Exception $execption
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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Could not find such a record'], 404);
        }
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 401);

        }
        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 401);
        }
        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 401);
        }

        return parent::render($request, $exception);
    }
}