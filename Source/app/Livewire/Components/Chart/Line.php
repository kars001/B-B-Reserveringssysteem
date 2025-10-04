<?php

namespace App\Livewire\Components\Chart;

use Livewire\Component;

class Line extends Component
{
    public $chartId;
    public $label;
    public $data;
    public $labels;

    public function render()
    {
        return view('livewire.components.chart.line', [
            'chartId' => $this->chartId,
            'label' => $this->label,
            'data' => $this->data,
            'labels' => $this->labels,
        ]);
    }
}
