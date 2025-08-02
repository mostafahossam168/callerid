<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function status()
    {
        return $this->status ? 'مفعل' : 'غير مفعل';
    }
    public function created_at()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    // public function subdepartments(): HasMany
    // {
    //     return $this->hasMany(Subdepartment::class);
    // }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
