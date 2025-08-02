<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password','type','active','phone','image','city_id'
    // ];

    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getRoleAttribute()
    {
        return $this->roles->first();
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function contacts()
    {
        return $this->hasMany(ContactName::class, 'user_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function scopeClients($q)
    {
        return $q->where('type', 'client');
    }

    public function scopeVendors($q)
    {
        return $q->where('type', 'vendor');
    }
    public function scopeDrivers($q)
    {
        return $q->where('type', 'driver');
    }

    public function scopeAdmins($q)
    {
        return $q->where('type', 'admin');
    }

    public function scopeActive($q)
    {
        return $q->where('active', 1);
    }

    public function scopeInActive($q)
    {
        return $q->where('active', 0);
    }

    public function fcm_tokens()
    {
        return  $this->hasMany(FcmToken::class);
    }
}
