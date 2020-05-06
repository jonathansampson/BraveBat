<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{
    public static function missing_field_response()
    {
        return response()->json(['success' => false, 'message' => "Missing required field"], 422);
    }

    public static function not_found()
    {
        return response()->json(['success' => false, 'message' => "Not found"], 404);
    }
}
