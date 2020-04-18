<?php

namespace App\Models;

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
        dump($incomings);
        // Handle incomings
        foreach ($incomings as $incoming) {
            $existing = self::where('creator', $incoming)->first();
            if ($existing) {
                $existing->active = true;
                $existing->save();
            } else {
                $parts = explode('#channel:', $incoming);
                if (count($parts) == 1) {
                    $channel = 'website';
                } else {
                    $channel = $parts[0];
                }
                self::create([
                    'creator' => $incoming,
                    'channel' => $channel
                ]);
            }
        }

        // Handle outgoings
        foreach ($outgoings as $outgoing) {
            $creator = self::where('creator', $outgoing)->first();
            $creator->active = false;
            $creator->save();
        }
    }
}
