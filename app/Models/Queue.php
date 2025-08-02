<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }
}
