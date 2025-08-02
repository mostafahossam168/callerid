<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionItem extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function pharmacyMedicine(): BelongsTo
    {
        return $this->belongsTo(PharmacyMedicine::class);
    }
    public function prescription(): BelongsTo
    {
        return $this->belongsTo(PharmacyPrescription::class,'pharmacy_prescription_id');
    }
}
