<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navLink extends Component
{
    public $active;
    public $icon;
    public $target;


    public function __construct($active = false, $target = null, $icon = null)
    {
        $this->active = $active;
        $this->icon = $icon;
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-link');
    }
}
