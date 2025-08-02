<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'country_id'];
    // public function clients(){
    //     return $this->hasMany(Client::class);
    // }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'city_id')->where('type', 'client');
    }
}