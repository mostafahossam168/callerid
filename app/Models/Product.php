<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function offer()
    {
        return $this->hasOne(Offer::class);
    }
    public function getTotalAttribute(){
        return $this->tax+$this->price;
    }
}
