<?php

namespace App\Http\Controllers\Api;

use App\Models\Creator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * @group v1
 */
class VimeoController extends Controller
{
    use ApiResponseTrait;
    /**
     * Vimeo
     * Check if a Vimeo channel is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the Vimeo 
     * link, channel name, channel description, the number of channel followers and the number of videos.
     * 
     * @bodyParam vimeo_id string required The Vimeo ID (example: "1512484"). Notice this is not Vimeo username that you might be familiar with. Example: 1512484
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "link": "https://vimeo.com/visiophone",
     *     "name": "visiophone",
     *     "display name": "visiophone",
     *     "description": null,
     *     "followers": 1702,
     *     "videos": 133
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
            'vimeo_id' => 'required'
        ]);
        if ($validator->fails()) {
            return self::missing_field_response();
        }

        $creator = Creator::where('channel', 'vimeo')
            ->where('channel_id', $request->vimeo_id)
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
                'videos' => $creator->video_count,
            ]
        ], 200);
    }
}
