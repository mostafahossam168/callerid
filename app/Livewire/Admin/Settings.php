<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;
    public $website_name, $website_url, $tax_number, $address, $building_number, $street_number, $phone, $iban, $is_tax, $is_can_send_email, $website_status, $logo, $fav, $maintainance_message, $show_logo, $show_fav;
    public $whatsapp , $snapchat,$twitter,$facebook,$instagram;
    public $rules = [
        'website_name' => 'required',
        'website_url' => 'nullable',
        'tax_number' => 'required',
        'address' => 'nullable',
        'building_number' => 'nullable',
        'street_number' => 'nullable',
        'phone' => 'required',
        'iban' => 'nullable',
        'is_tax' => 'nullable',
        'is_can_send_email' => 'nullable',
        'website_status' => 'nullable',
        'logo' => 'nullable|image',
        'fav' => 'nullable|image',
        'maintainance_message' => 'nullable',
        'whatsapp' =>'nullable',
        'snapchat'=>'nullable',
        'twitter' =>'nullable',
        'facebook' =>'nullable',
        'instagram' =>'nullable',
    ];
    public $files = [
        'logo',
        'fav'
    ];
    public function render()
    {
        $this->setScreenData();
        return view('livewire.admin.settings')->extends('admin.layouts.admin')->section('content');
    }

    public function mount()
    {
        $this->setScreenData();
    }

    public function setScreenData()
    {
        $keys = array_keys($this->rules);
        foreach ($keys as $item) {
            if (!in_array($item, $this->files)) {
                $this->{$item} = setting($item);
            } else {
                $this->{'show_' . $item} = setting($item);
            }
        }
    }

    public function save()
    {
        $data = $this->validate();
        // dd($data);
        foreach ($this->files as $file) {
            if (!is_null($data[$file]) && !empty($data[$file])) {
                delete_file($data[$file]);
                $data[$file] = store_file($data[$file], 'settings');
            } else {
                $data[$file] = setting($file);
            }
        }

        setting($data)->save();
        session()->flash('success','تم الحفظ بنجاح');

    }
}
