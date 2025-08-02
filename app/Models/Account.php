<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id', 'cost', 'depreciable', 'doctor_id'];
    public function parent()
    {
        return $this->belongsTo(Self::class, 'parent_id')->withDefault();
    }
    public static function boot()
    {
        parent::boot();
        self::created(function ($account) {
            $account->reviews()->create(['year' => Carbon::now()->format('Y')]);
        });
    }
    public function kids()
    {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')->withTrashed();
    }

    public function reviews()
    {
        return $this->hasMany(AccountReview::class);
    }

    public function vouchersAccounts()
    {
        return $this->hasMany(VoucherAccount::class);
    }

    public function islastChild()
    {
        $kid4 = $this->parent;
        if ($kid4) {
            if ($kid3 = $kid4->parent) {
                if ($kid2 = $kid3->parent) {
                    if ($kid1 = $kid2->parent) {
                        if ($kid1->parent) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function subAssets()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

    public static function parents()
    {
        return self::whereNull('parent_id')->get();
    }
}
