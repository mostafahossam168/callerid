<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function analysis()
    {
        return $this->hasOne(Analysis::class, 'invoice_item_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function vaccine(): BelongsTo
    {
        return $this->belongsTo(Vaccine::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}
