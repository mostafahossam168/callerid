<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'salary',
        'rate_type',
        'rate',
        'rate_active',
        'type',
        'department_id',
        'photo',
        'show_department_products',
        'is_dentist',
        'is_dermatologist',
        'warehouse_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends = ['monthly_income_from_invoices', 'monthly_discounts'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'show_department_products' => 'array',
    ];
    public function scopeDoctors($query)
    {
        return $query->where('type', 'dr');
    }
    public function scopeReceptions($query)
    {
        return $query->where('type', 'recep');
    }
    public function scopeAccounts($query)
    {
        return $query->where('type', 'accountant');
    }

    public function scopeAdmins($query)
    {
        return $query->where('type', 'admin');
    }

    public function scopeNotAdmin($query)
    {
        $query->where('type', '<>', 'admin');
    }

    public function getRoleAttribute()
    {
        return $this->roles->first();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function isAdmin()
    {
        return $this->type === 'admin';
    }
    // isDoctor
    public function isDoctor()
    {
        return $this->type === 'dr';
    }
    public function isScan()
    {
        return $this->type === 'scan';
    }
    public function isLab()
    {
        return $this->type === 'lab';
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'dr_id');
    }
    public function employee_invoices()
    {
        return $this->hasMany(Invoice::class, 'employee_id');
    }
    public function employee_bonds()
    {
        return $this->hasMany(InvoiceBond::class, 'user_id');
    }
    public function salaryDiscounts()
    {
        return $this->hasMany(Discount::class, 'user_id');
    }
    public function getMonthlyIncomeFromInvoicesAttribute()
    {
        $total_amount = $this->invoices()->whereMonth('created_at', Carbon::now()->month)->sum('total');
        if ($total_amount > $this->salary) {
            return $total_amount * ($this->rate / 100);
        }
        return 0;
    }
    public function getMonthlyDiscountsAttribute()
    {
        return $this->salaryDiscounts()->whereMonth('date', Carbon::now()->month)->sum('amount');
    }
    public static function TotalMonthlyIncome()
    {
        $users = User::withTrashed()->get();
        return $sum = array_reduce($users->toArray(), function ($carry, $item) {
            $carry += $item['salary'] + $item['monthly_income_from_invoices'] - $item['monthly_discounts'];
        });
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
    public function getNumOfVisitorsAttribute()
    {
        return $this->patients()->where('visitor', 1)->count();
    }
    public function employee_appointments()
    {
        return $this->hasMany(Appointment::class, 'employee_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function increases()
    {
        return $this->hasMany(Increase::class);
    }

    public function product_percents()
    {
        return $this->hasMany(ProductPercent::class, 'doctor_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'user_department', 'user_id', 'department_id');
    }

    public function animals()
    {
        return $this->hasMany(UserAnimal::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnose::class, 'dr_id');
    }


    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
