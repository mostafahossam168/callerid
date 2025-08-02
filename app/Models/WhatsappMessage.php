<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'image', 'patient_id', 'user_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed()->withDefault();
    }
}
