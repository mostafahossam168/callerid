<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'session_attachment', 'attended_at', 'doctor_attended_at', 'employee_id', 'doctor_id', 'clinic_id', 'room_id', 'appointment_number', 'appointment_type', 'appointment_status', 'appointment_reason', 'appointment_note', 'appointment_time', 'appointment_date', 'appointment_duration', 'animal_id', 'product_id'];
    // patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    // employee
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id')->withTrashed();
    }
    // doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id')->withTrashed();
    }
    // clinic
    public function clinic()
    {
        return $this->belongsTo(Department::class, 'clinic_id', 'id');
    }
    // room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    // scope examined
    public function scopeExamined($query)
    {
        return $query
            ->where('appointment_status', 'examined');
    }
    public function scopeSuspend($query)
    {
        return $query
            ->where('appointment_status', 'suspend');
    }
    // scope not examined
    public function scopeNotExamined($query)
    {
        return $query
            ->where('appointment_status', '<>', 'examined');
    }
    // transferred
    public function scopeTransferred($query)
    {
        return $query
            ->where('appointment_status', 'transferred');
    }
    // scope not transferred
    public function scopeNotTransferred($query)
    {
        return $query
            ->where('appointment_status', '<>', 'transferred');
    }
    // scope pending
    public function scopePending($query)
    {
        return $query
            ->where('appointment_status', 'pending');
    }
    public function scopeCancelled($query)
    {
        return $query
            ->where('appointment_status', 'cancelled');
    }
    public function scopeNotCancelled($query)
    {
        return $query
            ->where('appointment_status', '<>', 'cancelled');
    }
    // scope today
    public function scopeToday($query)
    {
        return $query->where('appointment_date', date('Y-m-d'));
    }
    // scope waiting
    public function scopeWaiting($query)
    {
        return $query
            ->pending()
            ->whereNull('appointment_date')
            ->whereNull('appointment_time');
    }
    // not waiting
    public function scopeNotWaiting($query)
    {
        return $query
            ->whereNotNull('appointment_date')
            ->whereNotNull('appointment_time');
    }
    // scope this hour
    public function scopeThisHour($query)
    {
        return $query
            ->notExamined()
            ->notTransferred()
            ->whereDate('appointment_date', date('Y-m-d'))
            ->where('appointment_time', '>=', Carbon::now()->format('H:i:s'))
            ->where('appointment_time', '<=', Carbon::now()->addHour()->format('H:i:s'));
    }
    public function scopeNotAttend($query)
    {
        return $query
            ->notExamined()
            ->Cancelled()
            ->notTransferred()
            ->whereDate('appointment_date', '<=', date('Y-m-d'))
            ->where('appointment_time', '<', Carbon::now()->format('H:i:s'));
    }


    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function animals()
    {
        return $this->belongsToMany(Animal::class);
    }

    public function scanRequests()
    {
        return $this->hasMany(ScanRequest::class, 'appointment_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function pharmacyPrescriptions()
    {
        return $this->hasMany(PharmacyPrescription::class, 'appointment_id');
    }
}
