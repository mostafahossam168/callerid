<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['amount_tax', 'net'];

    public function getAmountTaxAttribute()
    {
        $amount =     $this->amount;
        $tax = $this->tax / 100;
        return  $amount * $tax;
    }
    public function getNetAttribute()
    {
        $amount =     $this->amount;
        $taxamount = $this->amount_tax;
        return  $amount - $taxamount;
    }

    public function category()
    {
        if ($this->type == 'purchases') {
            return $this->belongsTo(PurchaseCategory::class, 'category_id');
        } else {
            return $this->belongsTo(Kind::class, 'category_id');
        }
    }
    public function categoryChild()
    {
        if ($this->type == 'purchases') {
            return $this->belongsTo(PurchaseCategory::class, 'category_id');
        } else {
            return $this->belongsTo(Kind::class, 'category_id');
        }
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
