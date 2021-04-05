<?php

namespace App\Tasks;

use App\Models\Creator;

class CreatorProcessingTask
{

    private $channel;
    private $days;
    private $sleep = 0;
    private $take;

    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }

    public function setDays($days)
    {
        $this->days = $days;
        return $this;
    }

    public function setSleep($sleep)
    {
        $this->sleep = $sleep;
        return $this;
    }

    public function setTake($take)
    {
        $this->take = $take;
        return $this;
    }

    public function process()
    {
        $newCreators = Creator::whereNull('last_processed_at')
            ->where('channel', $this->channel)
            ->take($this->take)
            ->get();
        $newCreators->each(function ($creator) {
            $creator->processCreatable();
            sleep($this->sleep);
        });

        $updatableCreators = Creator::where('updated_at', '<', now()->subDay($this->days))
            ->where('channel', $this->channel)
            ->orderBy('id', 'asc')
            ->take($this->take - $newCreators->count())
            ->get();

        $updatableCreators->each(function ($creator) {
            $creator->processCreatable();
            sleep($this->sleep);
        });
    }
}
