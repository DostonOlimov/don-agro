<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Generate a standardized error response.
     *
     * @param string $message The error message to be returned.
     * @param array $errors An array of errors (optional).
     * @param int $statusCode The HTTP status code for the response (default: 500).
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse(string $message, array $errors = [], int $statusCode = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
}
