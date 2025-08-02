<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PurchaseCategory;
use App\Traits\livewireResource;

class PurchaseCategories extends Component
{
    use livewireResource;
    public $name, $parent_id;
    protected function rules()
    {
        return [
            'name' => ['required'],
            'parent_id' => ['nullable'],
        ];
    }

    public function mount()
    {
    }
    public function render()
    {
        $mains = PurchaseCategory::whereNull('parent_id')->get();
        $kinds = PurchaseCategory::with('parent')->latest('id')->paginate(10);
        return view('livewire.purchase-categories', compact('kinds', 'mains'));
    }
}
