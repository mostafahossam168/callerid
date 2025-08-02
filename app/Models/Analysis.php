<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_item_id', 'patient_id', 'animal_id', 'product_id', 'user_id', 'results', 'form'];

    protected $casts = [
        'results' => 'json',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
