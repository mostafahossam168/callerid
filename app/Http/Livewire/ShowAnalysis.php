<?php

namespace App\Http\Livewire;

use App\Models\Analysis;
use Livewire\Component;

class ShowAnalysis extends Component
{
    public $analysis, $results;

    public function render()
    {
        return view('livewire.show-analysis');
    }

    public function mount(Analysis $analysis)
    {
        $this->analysis = $analysis;
        $this->results = $analysis->results;
     }
}
