<?php

namespace App\Models;

use App\Traits\EmployeeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemQuantity extends Model
{
    use HasFactory, EmployeeTrait;

    protected $fillable = ['item_id', 'quantity', 'warehouse_id', 'from_warehouse_id', 'to_warehouse_id', 'type', 'expire_date', 'employee_id', 'last_update', 'purchase_invoice_id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function from_warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'from_warehouse_id');
    }

    public function to_warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'to_warehouse_id');
    }
}
