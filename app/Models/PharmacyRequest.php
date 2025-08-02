<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'drugs' => 'array',
        'paid_drugs' => 'array',
        'drugs_quantity' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Department::class, 'clinic_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')->withTrashed();
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
