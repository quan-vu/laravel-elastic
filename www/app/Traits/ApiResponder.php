<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    public function success($data = null, string $message = 'Successful', $statusCode = 200): JsonResponse
    {
        return \response()->json([
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function error(array $errors = [], string $message = 'Something went wrong!', $statusCode = 500): JsonResponse
    {
        return \response()->json([
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}
