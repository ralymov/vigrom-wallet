<?php

namespace App\Traits;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

trait ApiExceptionHandlerTrait
{

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param  Request  $request
     * @param  Exception  $e
     * @return JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $e): JsonResponse
    {
        if ($e instanceof ModelNotFoundException) {
            return $this->modelNotFound();
        }
        if ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        }
        if ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        return $this->badRequest($e->getMessage());
    }

    /**
     * Returns json response for generic bad request.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    protected function badRequest($message = 'Bad request', $statusCode = 400): JsonResponse
    {
        return $this->jsonResponse(['error' => $message], $statusCode);
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    protected function modelNotFound($message = 'Record not found', $statusCode = 404): JsonResponse
    {
        return $this->jsonResponse(['error' => $message], $statusCode);
    }

    /**
     * Returns json response.
     *
     * @param  array|null  $payload
     * @param  int  $statusCode
     * @return JsonResponse
     */
    protected function jsonResponse(array $payload = null, $statusCode = 404): JsonResponse
    {
        $payload = $payload ?: [];

        return response()->json($payload, $statusCode);
    }

}
