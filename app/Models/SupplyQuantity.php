<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyQuantity extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['clinic','doctor'];

    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id')->withTrashed();
    }
    public function clinic(){
        return $this->belongsTo(Department::class,'clinic_id');
    }

}
