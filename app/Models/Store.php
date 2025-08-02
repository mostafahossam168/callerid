<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable=['name','parent'];
    public function main(){
        return $this->belongsTo(Kind::class,'parent');
    }
    public function kids(){
        return $this->hasMany(Kind::class,'parent');
    }
}
