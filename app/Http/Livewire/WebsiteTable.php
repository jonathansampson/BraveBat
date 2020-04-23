<?php

namespace App\Http\Livewire;

use App\Models\Creators\Website;
use Livewire\Component;
use Livewire\WithPagination;

class WebsiteTable extends Component
{
    public $search;
    public $perPage = 10;
    use WithPagination;

    public function render()
    {
        return view('livewire.website-table', [
            'websites' => Website::where('name', 'like', '%' . $this->search . '%')->orderBy('alexa_ranking', 'asc')->paginate($this->perPage)
        ]);
    }
}
