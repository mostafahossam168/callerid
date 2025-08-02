<?php

namespace App\Http\Livewire\Admin\Messages;

use App\Models\MessageLibrary;
use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithFileUploads;

class Image extends Component
{
    use livewireResource, WithFileUploads;

    public $name, $search, $attach = 2,$content,$file,$img;
    public function rules()
    {
        return ['content' => 'required', 'img' => 'nullable','attach'=>'required'];
    }
    public function beforeSubmit()
    {
        if($this->img){
            $this->data['file']=store_file($this->img,'messages');
        }
    }
    public function mount()
    {
        $this->model = 'App\Models\MessageLibrary';
    }
    public function render()
    {
        $messages = MessageLibrary::where('attach', 2)->paginate(10);
        return view('livewire.admin.messages.image', compact('messages'))->extends('admin.layouts.admin')->section('content');
    }
}
