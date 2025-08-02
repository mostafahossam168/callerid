<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id', 'account_id'];

    public function processes()
    {
        return $this->hasMany(ItemQuantity::class);
    }

    public function parent()
    {
        return $this->belongsTo(Warehouse::class, 'parent_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
