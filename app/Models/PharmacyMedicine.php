<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PharmacyMedicine extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dangerous(): BelongsTo
    {
        return $this->belongsTo(PharmacyDangerous::class, 'pharmacy_dangerous_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PharmacyType::class, 'pharmacy_type_id');
    }


    public function quantities()
    {
        return $this->morphMany(PharmacyQuantity::class, 'item');
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('expiry_date', '<', date('Y-m-d'));
    }

}
