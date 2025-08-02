<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;
    public $guarded = [];
    // protected $fillable = ['patient_id', 'category_id', 'name', 'gender', 'last_visit', 'age', 'type', 'breed_type'];
    protected $appends = ['last_visit'];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function animal()
    {
        return $this->belongsTo(Animal::class,'animal_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function strain()
    {
        return $this->belongsTo(Strain::class);
    }

    public function analyses()
    {
        return $this->hasMany(Analysis::class, 'animal_id');
    }

    // invoices
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class,'animal_id');
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnose::class);
    // return Diagnose::query();
    }

    public function files()
    {
        return $this->hasMany(PatientFile::class);
    // return PatientFile::query();
    }

    public function scanRequests()
    {
        return $this->hasMany(ScanRequest::class);
    // return ScanRequest::query();

    }

    public function labRequests()
    {
        return $this->hasMany(LabRequest::class);
    // return ScanRequest::query();

    }
    public function offerLogs()
    {
        return $this->hasMany(PointLog::class);
    // return PointLog::query();

    }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function inQueue()
    {
        return Queue::where('patient_id', $this->id)->first() ? true : false;
    }

    public function getlastVisitAttribute()
    {
        $lastAppointment = $this->appointments()->orderby('appointment_date', 'desc')->first();
        return $lastAppointment ? Carbon::parse($lastAppointment?->appointment_date . ' ' . $lastAppointment?->appointment_time)->translatedFormat('Y/m/d h:i A') : null;
    }
}
