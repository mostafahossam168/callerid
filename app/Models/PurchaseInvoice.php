<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'warehouse_id', 'amount', 'tax', 'total'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseInvoiceItem::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'purchase_invoice_id');
    }

    public function item_quantities()
    {
        return $this->hasMany(ItemQuantity::class, 'purchase_invoice_id');
    }
}
