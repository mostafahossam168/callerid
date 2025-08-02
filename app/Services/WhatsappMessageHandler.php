<?php

namespace App\Services;

use App\Models\Setting;
use App\Services\Whatsapp;
use Illuminate\Support\Str;
use App\Models\WhatsappMessage;

class WhatsappMessageHandler
{
    /**
     * TYPES : create , before , cancel
     */
    public static function notify($appointment, $type = 'create')
    {
        if (!setting()->whatsapp_status) {
            return null;
        }
        $setting = Setting::first();
        $patient = $appointment->patient;
        $msg = $setting->{$type . '_appointment_message'};
        $status = $setting->{$type . '_appointment_message_status'};
        if (!$status) {
            return null;
        }
        $msg = Str::replace(
            ['{userName}', '{appointmentNumber}', '{date}', '{time}', '{doctor}', '{product}', '{animal}', '{clinic}'],
            [$patient->name, $appointment->id, $appointment->appointment_date, $appointment->appointment_time, ($appointment->doctor?->name ?? ''), $appointment->product?->name, $appointment->animal?->name, $appointment->clinic?->name],
            $msg
        );
        if (!$msg) {
            return null;
        }
        $message = WhatsappMessage::create([
            'message' => $msg,
            'patient_id' => $patient->id,
            // 'user_id' => auth()->user()->id,
        ]);
        if ($patient->phone) {
            return Whatsapp::send($patient->phone, $message->message);
        }
    }

    public static function register($patient)
    {
        $setting = Setting::first();
        $msg = $setting->new_patient_message;
        $status = $setting->new_patient_message_status;

        if (!$status) {
            return null;
        }

        $msg = Str::replace(
            ['{userName}'],
            [$patient->name],
            $msg
        );
        if (!$msg) {
            return null;
        }
        $message = WhatsappMessage::create([
            'message' => $msg,
            'patient_id' => $patient->id,
        ]);
        if ($patient->phone) {
            return Whatsapp::send($patient->phone, $message->message);
        }
    }
}
