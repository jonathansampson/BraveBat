<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Creators\Website;
use App\Models\Creators\Youtube;
use Illuminate\Database\Eloquent\Model;
use Log;

class Creator extends Model
{
    protected $table = 'creators';
    protected $guarded = [];

    /**
     * Get the owning creatable model.
     */
    public function creatable()
    {
        return $this->morphTo();
    }

    /**
     * Handle input from Brave API
     *
     * @param $input
     * @return void
     */
    public static function handleInput($incomings, $outgoings)
    {
        Log::notice('start incoming');

        // Handle incomings
        foreach ($incomings as $incoming) {
            $existing = self::where('creator', $incoming)->first();
            if ($existing) {
                $existing->active = true;
                $existing->save();
            } else {
                self::create([
                    'creator' => $incoming,
                    'active' => true,
                    'channel' => '',
                    'verified_at' => Carbon::today()
                ]);
            }
        }
        Log::notice('start outgoing');

        // Handle outgoings
        foreach ($outgoings as $outgoing) {
            $creator = self::where('creator', $outgoing)->first();
            $creator->active = false;
            $creator->save();
        }

        Log::notice('start fill missing data');

        // Fill missing data 
        $missing_data = self::where('channel', '')->get();
        foreach ($missing_data as $creator) {
            $creator->fillChannel();
        }
    }

    public function fillChannel()
    {
        $parts = explode('#channel:', $this->creator);
        if (count($parts) == 1) {
            $this->channel = 'website';
        } else {
            $this->channel = $parts[0];
        }
        $this->save();
    }

    public function processCreatable()
    {
        if ($this->channel == 'website') {
            $this->processWesbite();
        } elseif ($this->channel == 'youtube') {
            $this->processYoutube();
        }
    }

    public function processWebsite()
    {
        $website = $this->creatable;
        if (!$website) {
            $website = Website::create(['name' => $this->creator]);
            $this->creatable()->associate($website)->save();
            $website->callApi();
        }
    }

    public function processYoutube()
    {
        $youtube = $this->creatable;
        if (!$youtube) {
            $youtube = Youtube::create();
            $this->creatable()->associate($youtube)->save();
            $youtube->callApi();
        }
    }
}
