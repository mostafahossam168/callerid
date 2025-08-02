<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientFile extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts= ['animal_test' => 'array'];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
    public function employee()
    {
        return $this->belongsTo(User::class , 'employee_id')->withTrashed();
    }
}
