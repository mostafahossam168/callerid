<?php

namespace App\Http\Livewire;

use App\Models\Warehouse;
use App\Traits\livewireResource;
use Livewire\Component;

class Warehouses extends Component
{
    use livewireResource;

    public $name, $parent_id;

    public function rules()
    {
        return [
            'name' => 'required',
            'parent_id' => 'nullable',
        ];
    }

    public function render()
    {
        $warehouses = Warehouse::paginate(10);
        $all_warehouses = Warehouse::all();
        return view('livewire.warehouses', compact('warehouses', 'all_warehouses'));
    }

    public function beforeSubmit()
    {
        $this->parent_id ? $this->data['parent_id'] = $this->parent_id : $this->data['parent_id'] = null;
    }
}
