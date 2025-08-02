<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactName extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    protected function IsMostUsed(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->contact->mostUsedName?->id == $this->id,
        );
    }
}
