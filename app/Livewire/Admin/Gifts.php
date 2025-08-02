<?php

namespace App\Livewire\Admin;

use App\Models\Gift;
use App\Traits\livewireResource;
use Livewire\Component;

class Gifts extends Component
{

    use livewireResource;
    public $name, $amount, $status = 1, $device_id, $code, $search, $opened = 0, $filter_status;
    public function setModelName()
    {
        $this->model = 'App\Models\Gift';
    }
    public function rules()
    {
        return [
            'name' => 'required',
            'amount' => ['required', 'unique:users,phone,' . $this->obj?->id],
            'code' => ['required', 'digits:4', 'unique:gifts,code,' . $this->obj?->id],
            'status' => 'required',
            'opened' => 'nullable',
            'device_id' => 'nullable',
        ];
    }

    public function toggle($id)
    {
        $gift = Gift::findOrFail($id);
        $gift->status = !$gift->status;
        $gift->save();
    }
    public function render()
    {
        $gifts = Gift::where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', '%' . $this->search . '%');
            }
            if ($this->filter_status) {
                if ($this->filter_status == 'active') {
                    $q->where('status', 1);
                }
                if ($this->filter_status == 'inactive') {
                    $q->where('status', 0);
                }
            }
        })->latest()->paginate(10);
        return view('livewire.admin.gifts.gifts', compact('gifts'))->extends('admin.layouts.admin')->section('content');
    }
}