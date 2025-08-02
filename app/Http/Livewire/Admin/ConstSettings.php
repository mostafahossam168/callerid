<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ConstSettings extends Component
{
    public $active_water_mark;
    public $water_mark_string;
    public $pharmacy_status;
    public  $active_mkhtbr;
    public function render()
    {
        return view('livewire.admin.const-settings')->extends('admin.layouts.admin')->section('content');
    }
    public function mount()
    {
        $this->active_water_mark = setting()->active_water_mark;
        $this->water_mark_string = setting()->water_mark_string;
        $this->pharmacy_status = setting()->pharmacy_status;
        $this->active_mkhtbr = setting()->active_mkhtbr;
    }
    public function submit()
    {
        $data = $this->validate([
            'active_water_mark' => 'nullable',
            'water_mark_string' => 'nullable',
            'pharmacy_status' => 'nullable',
            'active_mkhtbr' => 'nullable',
        ]);

        setting()->update($data);
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }
}