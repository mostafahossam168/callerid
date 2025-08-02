<?php

namespace App\Livewire\Admin;

use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithPagination;

class ContactUs extends Component
{
    use WithPagination, livewireResource;
    public  $search;
    public function rules()
    {
        return [

        ];
    }

    public function setModelName()
    {
        $this->model = 'App\Models\ContactUs';
    }
    public function render()
    {
        $contactuses = \App\Models\ContactUs::latest()->where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%$this->search%")
                ->orwhere('phone', 'LIKE', "%$this->search%")
                    ->orwhere('email', 'LIKE', "%$this->search%")
                    ->orwhere('message', 'LIKE', "%$this->search%");
            }

        })->paginate(10);
        // $this->dispatch('classicEditor');
        return view('livewire.admin.contact_us', compact('contactuses'))->extends('admin.layouts.admin')->section('content');
    }



}
