<?php

namespace App\Models\Creators;

use App\Services\VimeoService;
use Illuminate\Database\Eloquent\Model;

class Vimeo extends Model
{
    use CreatableTrait;

    protected $guarded = [];
    protected $table = 'creator_vimeo';

    public function callApi()
    {
        $service = cache()->remember('vimeo_service', 1800, function () {
            return new VimeoService();
        });
        if ($this->vimeo_id) {
            $response = $service->getUser($this->vimeo_id);
            if ($response['success']) {
                $this->update($response['result']);
                $this->syncName();
            }
        }
    }
}
