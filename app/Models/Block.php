<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Block extends Model
{
    protected $guarded =['id'];

    public function contactName(): BelongsTo
    {
        return $this->belongsTo(ContactName::class);
    }
}
