<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'account_id', 'is_active'];
 
    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function vouchers()
    {
        $this->account->vouchersAccounts()->count();
    }

}
