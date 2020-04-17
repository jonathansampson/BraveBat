<?php

namespace App\Models\Creators;

use App\Models\Creators\CreatorInterface;
use Illuminate\Database\Eloquent\Model;

class Website extends Model implements CreatorInterface
{
    protected $table = 'website';

    public function active()
    {
        return true;
    }
}
