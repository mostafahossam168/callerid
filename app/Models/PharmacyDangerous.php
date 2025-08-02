<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PharmacyDangerous extends Model
{
    use HasFactory;
    protected $guarded= ['id'];

    public function pharmacyMedicines(): HasMany
    {
        return $this->hasMany(PharmacyMedicine::class, 'pharmacy_dangerous_id');
    }
}
