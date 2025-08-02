<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Livewire\WithPagination;

class DoctorHome extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $screen = 'latest', $from, $to;
    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('appointment_date', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('appointment_date', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('appointment_date', '<=', $this->to);
        } else {
            $query;
        }
    }
    public function confirm($id)
    {
        $appointment = Appointment::find($id);
        $appointment->appointment_status = 'confirmed';
        $appointment->save();
    }
    // cancel appointment status by id
    public function cancel($id)
    {
        $appointment = Appointment::find($id);
        $appointment->appointment_status = 'cancelled';
        $appointment->save();
    }
    public function render()
    {
        $appoints = doctor()->appointments()->today()->with('patient')->paginate(10);
        $doctor = doctor()->with(['appointments' => function ($q) {
            $this->between($q);
        }])->first();
        return view('livewire.doctor-home', compact('appoints', 'doctor'));
    }
}
