<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PharmacyPrescription extends Model
{
    use HasFactory;
    protected $guarded =[
        'id'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PrescriptionItem::class, 'pharmacy_prescription_id');
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function pharmacist(): BelongsTo
    {
        return $this->belongsTo(User::class,'pharmacist_id');
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class, 'pharmacy_prescription_id');
    }
}
