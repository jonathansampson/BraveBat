<?php

namespace App\Http\Controllers\Api;

use App\Models\Creator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * @group v1
 */
class YoutubeController extends Controller
{
    use ApiResponseTrait;
    /**
     * YouTube
     * Check if a YouTube channel is a verified Brave Browser Creator
     * 
     * @bodyParam youtube_id string required The YouTube ID (example: "UCr_USjgn4PQhVpqOT6RcAtQ") Example: UC2F_7pXTR8LNg3llt55ZMCQ
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "link": "https://www.youtube.com/channel/UCr_USjgn4PQhVpqOT6RcAtQ",
     *     "name": "Some name",
     *     "description": "Some description",
     * 
     *     "subscribers": 1000
     *   }
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
            'youtube_id' => 'required'
        ]);
        if ($validator->fails()) {
            return self::missing_field_response();
        }

        $creator = Creator::where('channel', 'youtube')
            ->where('channel_id', $request->youtube_id)
            ->first();

        if (!$creator) {
            return self::not_found();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'link' => $creator->link,
                'name' => $creator->name,
                'description' => $creator->description,
                'subscriber' => $creator->follower_count
            ]
        ], 200);
    }
}
