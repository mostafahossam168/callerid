<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submit extends Model
{
    use HasFactory;
    protected $casts=[
        'choices'=>'json'
    ];
    protected $fillable=['patient_id','choices'];
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
