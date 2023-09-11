<?php

namespace App\Exceptions\ApiHandlers;

use Illuminate\Http\Request;

class NotFoundModelExceptionHandler
{
    public function __invoke(Request $request, \Throwable $exception)
    {
        $debug = env('APP_DEBUG', false);
        if ($request->isJson() || $request->wantsJson()) {
            $response = [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
            return response()->json($response, 404);

        }
    }
}
