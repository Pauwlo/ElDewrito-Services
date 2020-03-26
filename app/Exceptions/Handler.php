<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($this->shouldHideError($exception)) {
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $exception);
    }

    /**
     * Determine if the error should be hidden.
     *
     * @param  \Throwable  $exception
     * @return bool
     */
    private function shouldHideError(Throwable $exception)
    {
        if (app()->environment() != "production")
            return false;
        
        $publicErrors = [404, 419, 429, 500, 503];

        if ($exception instanceof HttpException && in_array($exception->getStatusCode(), $publicErrors))
            return false;
        
        if (!$exception instanceof HttpException)
            return false;
        
        return true;
    }
}
