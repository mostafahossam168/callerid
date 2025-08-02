<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_invoice_id', 'item_id', 'quantity', 'cost_price', 'sell_price'];
}
