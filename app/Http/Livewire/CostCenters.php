<?php

namespace App\Http\Livewire;

use App\Models\CostCenter;
use App\Traits\livewireResource;
use Livewire\Component;

class CostCenters extends Component
{
    use livewireResource;

    public $name;

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function render()
    {
        $centers = CostCenter::paginate(10);
        return view('livewire.cost-centers', compact('centers'));
    }
}