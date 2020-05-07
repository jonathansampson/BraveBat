<?php

namespace App\Http\Controllers\Api;

use App\Models\Creator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * @group v1
 */
class TwitchController extends Controller
{
    use ApiResponseTrait;
    /**
     * Twitch
     * Check if a Twitch channel is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the Twitch 
     * link, name, display name, description, the number of followers and the number of views.
     * 
     * @bodyParam twitch_id string required The Twitch ID (example: "zerator") Example: zerator
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "link": "https://www.twitch.tv/zerator",
     *     "name": "zerator",
     *     "display_name": "ZeratoR",
     *     "description": "Créateur de contenu vidéo /  French Streamer and Videomaker / Everything is on : http://www.ZeratoR.com",
     *     "followers": 808737,
     *     "views": 83595247
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
            'twitch_id' => 'required'
        ]);
        if ($validator->fails()) {
            return self::missing_field_response();
        }

        $creator = Creator::where('channel', 'twitch')
            ->where('channel_id', $request->twitch_id)
            ->first();

        if (!$creator) {
            return self::not_found();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'link' => $creator->link,
                'name' => $creator->name,
                'display_name' => $creator->display_name,
                'description' => $creator->description,
                'followers' => $creator->follower_count,
                'views' => $creator->view_count
            ]
        ], 200);
    }
}
