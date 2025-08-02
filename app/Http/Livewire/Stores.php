<?php

namespace App\Http\Livewire;

use App\Models\Store;
use App\Traits\livewireResource;
use Livewire\Component;

class Stores extends Component
{
    use livewireResource;
    public $name,$parent;
    protected function rules(){
        return [
            'name' => ['required'],
            'parent' => ['nullable'],
        ];
    } 
    
    public function mount(){
    }
    public function render()
    {
        $mains=Store::whereNull('parent')->get();
        $stores=Store::with('main')->latest('id')->paginate(10);
        return view('livewire.stores',compact('stores','mains'));
    }
}
