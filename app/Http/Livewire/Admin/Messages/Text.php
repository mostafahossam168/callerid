<?php

namespace App\Http\Livewire\Admin\Messages;

use App\Models\MessageLibrary;
use App\Traits\livewireResource;
use Livewire\Component;

class Text extends Component
{
    use livewireResource;
    public $name, $search, $attach = 1, $content;
    public function rules()
    {
        return ['content' => 'required', 'attach' => 'required'];
    }
    public function mount()
    {
        $this->model = 'App\Models\MessageLibrary';
    }
    public function render()
    {
        $messages = MessageLibrary::where('attach', 1)->paginate(10);
        return view('livewire.admin.messages.text', compact('messages'))->extends('admin.layouts.admin')->section('content');
    }
}
