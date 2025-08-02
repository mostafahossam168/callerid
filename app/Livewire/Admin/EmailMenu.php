<?php

namespace App\Livewire\Admin;

use App\Models\EmailMenu as ModelsEmailMenu;
use Livewire\Component;
use Livewire\WithPagination;

class EmailMenu extends Component
{
    use WithPagination;
    public $name, $search, $message , $email_id;
    public function rules()
    {
        return [
            'message' => ['required']
        ];
    }

    public function render()
    {
        $emails = ModelsEmailMenu::latest()->where(function ($q) {
            if ($this->search) {
                $q->where('email', 'LIKE', "%$this->search%");
            }
        })->paginate(10);
        //$this->dispatch('classicEditor');
        return view('livewire.admin.emails_menu.emails_menu', compact('emails'))->extends('admin.layouts.admin')->section('content');
    }

    public function submit()
    {
        $data = $this->validate();

        $ModelsEmailMenu = ModelsEmailMenu::findOrFail($this->email_id);

        $ModelsEmailMenu->update($data);
        $this->dispatch('alert', ['type' => 'success', 'message' => 'تم الارسال  بنجاح']);
        $this->dispatch('closemodel');
        $this->dispatch('storeOrUpdate');

    }

    public function edit(ModelsEmailMenu $email)
    {
        $this->email_id = $email->id;
    }



}
