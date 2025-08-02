<?php

namespace App\Http\Livewire\Admin\Messages;

use App\Models\WhatsappMessage;
use Livewire\Component;

class MessagesSent extends Component
{
    public function render()
    {
        $msgs = WhatsappMessage::latest('id')->paginate();
        return view('livewire.admin.messages.messages-sent', compact('msgs'))->extends('admin.layouts.admin')->section('content');
    }
}
