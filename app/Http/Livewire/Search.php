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
    }

    public function render()
    {
        if (strlen($this->search) >= 2) {
            $this->searchResults = Creator::query()
                ->where("valid", true)
                ->whereNotNull("name")
                ->whereNotNull('ranking')
                ->where('name', 'LIKE', '%' . $this->search . '%')
                ->orderBy('ranking', 'asc')
                ->take(10)
                ->get();
        }
        return view('livewire.search');
    }
}
