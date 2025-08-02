<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    public function scopeInActive($q)
    {
        return $q->where('status', 0);
    }
}