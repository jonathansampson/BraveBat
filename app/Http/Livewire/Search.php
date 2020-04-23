<?php

namespace App\Http\Livewire;

use App\Models\Creator;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $searchResults;

    public function mounted()
    {
        $this->clear();
    }

    public function clear()
    {
        $this->search = '';
        $this->searchResults = [];
        $this->highlightIndex = 0;
    }

    public function render()
    {
        if (strlen($this->search) >= 2) {
            $this->searchResults = Creator::query()
                ->whereNotNull('rank')
                ->where('name', 'LIKE', '%' . $this->search . '%')
                ->orderBy('rank', 'asc')
                ->take(10)
                ->get();
        }
        return view('livewire.search');
    }
}
