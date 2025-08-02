<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailMenu extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $table = "emails_menu";
}
