<?php

namespace App\Exceptions;

use App\Traits\ApiExceptionHandlerTrait;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    use ApiExceptionHandlerTrait;

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
     * @param  Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param  Exception  $exception
     * @return JsonResponse|Response
     */
    public function render($request, Exception $exception)
    {
        if (!$this->isApiCall($request)) {
            return parent::render($request, $exception);
        }
        return $this->getJsonResponseForException($request, $exception);
    }

    /**
     * Determines if request is an api call.
     * @param  Request  $request
     * @return bool
     */
    private function isApiCall(Request $request): bool
    {
        return strpos($request->getUri(), '/api/') !== false;
    }
}
