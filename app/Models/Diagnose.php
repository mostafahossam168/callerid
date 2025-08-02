<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diagnose extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'tooth' => 'json',
        'body' => 'json',
        'vaccinations' => 'array',
        'sensitivity' => 'array',
        'cupping_type' => 'array',
        'body_parts' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function appoint()
    {
        return $this->belongsTo(Appointment::class,'appointment_id');
    }
    public function dr()
    {
        return $this->belongsTo(User::class, 'dr_id', 'id')->withTrashed();
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
    public function attachments()
    {
        return $this->hasMany(DiagnoseAttachment::class);
    }
}
