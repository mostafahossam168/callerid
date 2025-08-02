<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['quantity', 'warehouses'];

    public function getTotalAttribute()
    {
        return round($this->tax + $this->sale_price, 2);
    }

    public function getTaxAttribute()
    {
        $tax = setting()->tax_rate && setting()->tax_rate > 0 ?  $this->sale_price * (setting()->tax_rate / 100) : 0;
        return round($tax ?? 0.0, 2);
    }

    public function getSalePriceAttribute()
    {
        return round($this->attributes['sale_price'], 2);
    }

    public function quantities()
    {
        return $this->hasMany(ItemQuantity::class)->where('warehouse_id', auth()->user()->warehouse_id);
    }

    public function all_quantities()
    {
        return $this->hasMany(ItemQuantity::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class)->where('warehouse_id', auth()->user()->warehouse_id);
    }

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    public function all_order_items()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function getQuantityAttribute()
    {
        return  $this->all_quantities()->where('type', 'charge')->sum('quantity') - $this->all_quantities()->where('type', 'expense')->sum('quantity') - $this->order_items()->sum('quantity');
    }

    public function getWarehousesAttribute()
    {
        $warehouses_ids = $this->all_quantities()->pluck('warehouse_id')->toArray();
        $warehouses = Warehouse::whereIn('id', $warehouses_ids)->get();

        return $warehouses;
    }
}
