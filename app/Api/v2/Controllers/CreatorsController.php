<?php

namespace App\Api\v2\Controllers;

use App\Api\v2\Controllers\ApiBaseController;
use App\Api\v2\Resources\CreatorGithubResource;
use App\Api\v2\Resources\CreatorRedditResource;
use App\Api\v2\Resources\CreatorTwitchResource;
use App\Api\v2\Resources\CreatorTwitterResource;
use App\Api\v2\Resources\CreatorVimeoResource;
use App\Api\v2\Resources\CreatorWebsiteResource;
use App\Api\v2\Resources\CreatorYoutubeResource;
use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreatorsController extends ApiBaseController
{

    public function github(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'github_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->missingFieldResponse($validator->getMessageBag()->first());
        }
        $creator = Creator::where('channel', 'github')
            ->where('channel_id', $request->github_id)
            ->first();
        if (!$creator) {
            return $this->notFoundResponse('github');
        }
        return new CreatorGithubResource($creator);
    }

    public function website(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->missingFieldResponse($validator->getMessageBag()->first());
        }
        $url = $request->url;
        $url = str_ireplace('http://', '', $url);
        $url = str_ireplace('https://', '', $url);
        $url = explode('/', $url)[0];

        $creator = Creator::where('channel', 'website')
            ->where('channel_id', $url)
            ->first();

        if (!$creator) {
            return $this->notFoundResponse('website');
        }
        return new CreatorWebsiteResource($creator);
    }

    public function reddit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reddit_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->missingFieldResponse($validator->getMessageBag()->first());
        }

        $creator = Creator::where('channel', 'reddit')
            ->where('channel_id', $request->reddit_id)
            ->first();

        if (!$creator) {
            return $this->notFoundResponse('reddit');
        }
        return new CreatorRedditResource($creator);
    }

    public function twitch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'twitch_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->missingFieldResponse($validator->getMessageBag()->first());
        }

        $creator = Creator::where('channel', 'twitch')
            ->where('channel_id', $request->twitch_id)
            ->first();

        if (!$creator) {
            return $this->notFoundResponse('twitch');
        }
        return new CreatorTwitchResource($creator);
    }

    public function twitter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'twitter_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->missingFieldResponse($validator->getMessageBag()->first());
        }

        $creator = Creator::where('channel', 'twitter')
            ->where('channel_id', $request->twitter_id)
            ->first();

        if (!$creator) {
            return $this->notFoundResponse('twitter');
        }
        return new CreatorTwitterResource($creator);
    }

    public function vimeo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vimeo_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->missingFieldResponse($validator->getMessageBag()->first());
        }

        $creator = Creator::where('channel', 'vimeo')
            ->where('channel_id', $request->vimeo_id)
            ->first();

        if (!$creator) {
            return $this->notFoundResponse('vimeo');
        }
        return new CreatorVimeoResource($creator);
    }

    public function youtube(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'youtube_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->missingFieldResponse($validator->getMessageBag()->first());
        }

        $creator = Creator::where('channel', 'youtube')
            ->where('channel_id', $request->youtube_id)
            ->first();

        if (!$creator) {
            return $this->notFoundResponse('youtube');
        }
        return new CreatorYoutubeResource($creator);
    }

    public function missingFieldResponse($message)
    {
        return response()->json([
            'error' => 'missing_field',
            'message' => $message,
        ], 422);
    }

    public function notFoundResponse($channel)
    {
        return response()->json([
            'error' => 'not_found',
            'message' => "We cannot find this {$channel} creator.",
        ], 404);
    }
}
