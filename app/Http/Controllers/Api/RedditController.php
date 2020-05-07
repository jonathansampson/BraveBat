<?php

namespace App\Http\Controllers\Api;

use App\Models\Creator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * @group v1
 */
class RedditController extends Controller
{
    use ApiResponseTrait;
    /**
     * Reddit
     * Check if a Reddit account is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the 
     * confirmation. No additional data points are returned currently. 
     * 
     * @bodyParam reddit_id string required The Reddit ID (example: "2lsiek42"). Notice this is not Reddit username that you might be familiar with. Example: 2lsiek42
     * @response 200 {
     *   "success": true
     * }
     * @response 422 {
     *   "success": false,
     *   "message": "Missing required field"
     * }
     * @response 404 {
     *   "success": false,
     *   "message": "Not found"
     * }
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reddit_id' => 'required'
        ]);
        if ($validator->fails()) {
            return self::missing_field_response();
        }

        $creator = Creator::where('channel', 'reddit')
            ->where('channel_id', $request->reddit_id)
            ->first();

        if (!$creator) {
            return self::not_found();
        }

        return response()->json([
            'success' => true
        ], 200);
    }
}
