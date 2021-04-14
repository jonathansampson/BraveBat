<?php

namespace App\Api\v2\Controllers;

use App\Http\Controllers\Controller;

class ApiBaseController extends Controller
{
    public function missingFieldResponse($message)
    {
        return response()->json([
            'error' => 'missing_field',
            'message' => $message,
        ], 422);
    }

    // public function notFoundResponse($channel)
    // {
    //     return response()->json([
    //         'error' => 'not_found',
    //         'message' => "We cannot find this {$channel} creator.",
    //     ], 404);
    // }

    public function notFoundResponse($message)
    {
        return response()->json([
            'error' => 'not_found',
            'message' => $message,
        ], 404);
    }
}
