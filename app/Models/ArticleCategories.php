<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategories extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];
}
