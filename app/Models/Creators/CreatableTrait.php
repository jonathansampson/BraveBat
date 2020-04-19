<?php

namespace App\Models\Creators;

trait CreatableTrait
{
    public function creator()
    {
        return $this->morphOne('App\Models\Creator', 'creatable');
    }

    public function syncName()
    {
        $creator = $this->creator;
        if ($creator) {
            $creator->name = $this->name;
            $creator->save();
        }
    }
}
