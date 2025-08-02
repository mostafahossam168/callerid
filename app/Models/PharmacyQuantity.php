<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PharmacyQuantity extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function pharmacyWarehouse(): BelongsTo
    {
        return $this->belongsTo(PharmacyWarehouse::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function fromWarehouse(): BelongsTo
    {
        return $this->belongsTo(PharmacyWarehouse::class);
    }

    public function toWarehouse(): BelongsTo
    {
        return $this->belongsTo(PharmacyWarehouse::class);
    }

    public function scopeCharge(Builder $query): Builder
    {
        return $query->where('type','charge');
    }
    public function scopeExpense(Builder $query): Builder
    {
        return $query->where('type','expense');
    }
}
