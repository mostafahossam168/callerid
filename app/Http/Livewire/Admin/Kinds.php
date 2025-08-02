<?php

namespace App\Http\Livewire\Admin;

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
        return view('livewire.admin.kinds',compact('kinds','mains'));
    }
}
