<?php

namespace App\Livewire\Components;

use Livewire\Component;

class StatCard extends Component
{
    public $title;
    public $icon;
    public $value;

    public function render()
    {
        return view('livewire.components.stat-card');
    }
}
