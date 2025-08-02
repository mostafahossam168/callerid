<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class SendMessageSettings extends Component
{
    public $befor_appointment_message_status,
        $befor_appointment_message,
        $create_appointment_message_status,
        $create_appointment_message,
        $cancel_appointment_message_status,
        $cancel_appointment_message,
        $new_patient_message_status,
        $new_patient_message;

    public function render()
    {
        return view('livewire.admin.send-message-settings')->extends('admin.layouts.admin')->section('content');
    }


    public function save()
    {
        $data = $this->validate([
            'befor_appointment_message_status' => 'nullable',
            'befor_appointment_message' => 'nullable',
            'create_appointment_message_status' => 'nullable',
            'create_appointment_message' => 'nullable',
            'cancel_appointment_message_status' => 'nullable',
            'cancel_appointment_message' => 'nullable',
            'new_patient_message_status' => 'nullable',
            'new_patient_message' => 'nullable',
        ]);

        $setting = Setting::first();
        $setting->update($data);
        session()->flash('success', 'تم الحفظ بنجاح');
    }
    public function  mount()
    {
        $setting = Setting::first();
        $this->befor_appointment_message_status = $setting->befor_appointment_message_status;
        $this->befor_appointment_message = $setting->befor_appointment_message;
        $this->create_appointment_message_status = $setting->create_appointment_message_status;
        $this->create_appointment_message = $setting->create_appointment_message;
        $this->cancel_appointment_message_status = $setting->cancel_appointment_message_status;
        $this->cancel_appointment_message = $setting->cancel_appointment_message;
        $this->new_patient_message_status = $setting->new_patient_message_status;
        $this->new_patient_message = $setting->new_patient_message;
    }
}
