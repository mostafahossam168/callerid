<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnimal extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "user_animal";

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
