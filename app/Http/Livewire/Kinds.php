<?php

namespace App\Http\Livewire;

use App\Models\Kind;
use App\Traits\livewireResource;
use Livewire\Component;

class Kinds extends Component
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
        $mains=Kind::whereNull('parent')->get();
        $kinds=Kind::with('main')->latest('id')->paginate(10);
        return view('livewire.kinds',compact('kinds','mains'));
    }
}
