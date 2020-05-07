<?php

namespace App\Http\Controllers\Api;

use App\Models\Creator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * @group v1
 */
class TwitterController extends Controller
{
    use ApiResponseTrait;
    /**
     * Twitter
     * Check if a Twitter account is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the Twitter 
     * link, handle, display name, description and the number of followers.
     * 
     * @bodyParam twitter_id string required The Twitter ID (example: "3488129179"). Notice this is not Twitter handle that you might be familiar with. Example: 3488129179
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "link": "https://twitter.com/FreakyTheory",
     *     "handle": "FreakyTheory",
     *     "display_name": "Motivation",
     *     "description": "Stop Doubting & Start Living a Wealthy Life.We Don't own any of the pictures!",
     *     "followers": 3702201
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
            'twitter_id' => 'required'
        ]);
        if ($validator->fails()) {
            return self::missing_field_response();
        }

        $creator = Creator::where('channel', 'twitter')
            ->where('channel_id', $request->twitter_id)
            ->first();

        if (!$creator) {
            return self::not_found();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'link' => $creator->link,
                'handle' => $creator->name,
                'display_name' => $creator->display_name,
                'description' => $creator->description,
                'followers' => $creator->follower_count
            ]
        ], 200);
    }
}
