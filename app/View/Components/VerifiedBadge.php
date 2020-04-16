<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VerifiedBadge extends Component
{
    public $verifiedDate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($verifiedDate = null)
    {
        $this->verifiedDate = $verifiedDate;
    }


    public function verifiedDateString()
    {
        if (!$this->verifiedDate) {
            return 'Verfied before Apr 2020';
        } else {
            return 'Verified on ' .  $this->verifiedDate;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.verified-badge');
    }
}
