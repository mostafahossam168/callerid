<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent'];

    public function main()
    {
        return $this->belongsTo(Self::class, 'parent');
    }
    public function children()
    {
        return $this->hasMany(Self::class, 'parent');
    }
 
}
