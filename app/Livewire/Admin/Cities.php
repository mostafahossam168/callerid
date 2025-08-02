<?php

namespace App\Livewire\Admin;

use App\Models\City;
use App\Models\Clinic;
use App\Traits\livewireResource;
use Livewire\Component;

class Cities extends Component
{
    use livewireResource;
    public $name, $search, $country_id;
    public function rules()
    {
        return ['name' => 'required', 'country_id' => 'nullable'];
    }
    public function render()
    {
        $cities = City::withCount('users')->where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%" . $this->search . "%");
            }
        })->latest('id')->paginate();
        return view('livewire.admin.cities', compact('cities'))->extends('admin.layouts.admin')->section('content');
    }
}