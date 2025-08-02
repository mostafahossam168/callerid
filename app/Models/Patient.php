<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['last_visit'];
    // invoices
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function diagnoses()
    {
        return $this->hasMany(Diagnose::class);
    }
    // files
    public function files()
    {
        return $this->hasMany(PatientFile::class);
    }
    // appointments

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->parent_name . ' ' . $this->grand_name . ' ' . $this->last_name;
    }
    public function getHasAppointTransAttribute()
    {
        // return $this->appointments()->latest()->first()->appointment_status == 'transferred' ? true : false;
    }
    // scan requests
    public function scanRequests()
    {
        return $this->hasMany(ScanRequest::class);
    }
    public function labRequests()
    {
        return $this->hasMany(LabRequest::class);
    }
    public function analyses()
    {
        return $this->hasMany(Analysis::class, 'patient_id');
    }
    // set is pregnant attribute
    public function setIsPregnantAttribute($value)
    {
        $this->attributes['is_pregnant'] = $value ? 1 : 0;
    }

    public function inQueue()
    {
        return Queue::where('patient_id', $this->id)->first() ? true : false;
    }
    public function offerLogs()
    {
        return $this->hasMany(PointLog::class);
    }
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function scans()
    {
        return $this->hasMany(PatientFile::class, 'patient_id')->where('type', 'scan');
    }

    public function labs()
    {
        return $this->hasMany(PatientFile::class, 'patient_id')->where('type', 'lab');
    }

    public function getLastVisitAttribute()
    {
        return $this->appointments()->latest()->first()?->appointment_date;
    }
}
