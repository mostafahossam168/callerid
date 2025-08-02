<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function kind()
    {
        return $this->belongsTo(Kind::class, 'kind_id');
    }

    public function quantities()
    {
        return $this->hasMany(SupplyQuantity::class);
    }
}
