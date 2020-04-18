<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $table = 'creators';
    protected $guarded = [];

    /**
     * Handle input from Brave API
     *
     * @param $input
     * @return void
     */
    public static function handleInput($incomings, $outgoings)
    {
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

        // Handle outgoings
        foreach ($outgoings as $outgoing) {
            $creator = self::where('creator', $outgoing)->first();
            $creator->active = false;
            $creator->save();
        }

        // Fill missing data 
        // $missing_data = self::where('channel', '')->get();
        // foreach ($missing_data as $creator) {
        //     $creator->fillChannel();
        // }
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
}
