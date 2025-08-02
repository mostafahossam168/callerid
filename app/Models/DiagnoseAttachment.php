<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiagnoseAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function diagnose()
    {
        return $this->belongsTo(Diagnose::class);
    }
}
