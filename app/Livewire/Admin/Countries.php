<?php

namespace App\Livewire\Admin;

use App\Models\Country;
use App\Traits\livewireResource;
use Livewire\Component;

class Countries extends Component
{
    use livewireResource;
    public $name, $search;
    public function rules()
    {
        return ['name' => 'required'];
    }
    public function render()
    {
        $countries = Country::where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%" . $this->search . "%");
            }
        })->latest('id')->paginate();
        return view('livewire.admin.countries', compact('countries'))->extends('admin.layouts.admin')->section('content');
    }
}