<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScanRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    // pending scope
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    //patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    //doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'dr_id');
    }
    //clinic
    public function clinic()
    {
        return $this->belongsTo(Department::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}
