<?php

namespace App\Http\Livewire;

use App\Models\Creator;
use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];
        if (strlen($this->search) >= 2) {
            $searchResults = Creator::where('name', 'LIKE', '%' . $this->search . '%')->get();
            // $searchResults = Http::withToken(config('services.tmdb.token'))
            //     ->get('https://api.themoviedb.org/3/search/movie?query=' . $this->search)
            //     ->json()['results'];
        }

        return view('livewire.search', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}
