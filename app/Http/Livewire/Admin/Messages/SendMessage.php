<?php

namespace App\Http\Livewire\Admin\Messages;

use App\Models\Patient;
use Livewire\Component;
use App\Models\MessageLibrary;
use App\Jobs\SendWhatsappMessageJob;

class SendMessage extends Component
{
    public $msg_type, $message_id, $count, $prev, $patient_id;
    public function rules()
    {
        return [
            'message_id' => 'required',
            'patient_id' => 'required',
        ];
    }
    public function submit()
    {
        $data = $this->validate();
        $msg = MessageLibrary::findOrFail($this->message_id);

        if ($this->patient_id == 'all') {
            $receivers = Patient::all();
        } else {
            $receivers = collect([Patient::find($this->patient_id)]);
        }
        dispatch(new SendWhatsappMessageJob($receivers, $msg, auth()->id()));
        $this->reset('message_id', 'patient_id', 'msg_type');
        session()->flash('success', 'تم الارسال بنجاح');
    }

    public function render()
    {
        $msgs = MessageLibrary::where(function ($q) {
            if ($this->msg_type) {
                $q->where('attach', $this->msg_type);
            }
        })->get();

        $all_patients = Patient::all();
        return view('livewire.admin.messages.send-message', compact('msgs', 'all_patients'))->extends('admin.layouts.admin')->section('content');
    }
}
