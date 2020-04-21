<?php

namespace App\View\Components;

use App\Models\Creator;
use Illuminate\View\Component;

class StatsBadge extends Component
{
    public $test;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->test = '12';
    }

    public function creatorCount()
    {
        return round(Creator::count() / 1000);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.stats-badge');
    }
}
