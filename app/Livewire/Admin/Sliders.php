<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use App\Traits\livewireResource;
use Livewire\Component;

class Sliders extends Component
{
    use livewireResource;

    public $cover, $title, $subtitle;

    public function rules()
    {
        return [
            'cover' => 'required',
            'title' => 'required|unique:sliders,title,' . $this->obj?->id,
            'subtitle' => 'nullable',
        ];
    }

    public function beforeSubmit()
    {
        if ($this->cover) {
            if ($this->obj) {
                if ($this->obj->cover !== $this->cover) {
                    delete_file($this->obj->cover);
                    $this->data['cover'] = store_file($this->cover, 'slider_cover');
                }
            } else {
                $this->data['cover'] = store_file($this->cover, 'slider_cover');
            }
        }
    }

    public function render()
    {
        $sliders = Slider::paginate();
        return view('livewire.admin.sliders', compact('sliders'))->extends('admin.layouts.admin')->section('content');
    }
}
