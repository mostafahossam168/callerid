<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Department;
use App\Models\Appointment;

class AppointmentsInfo extends Component
{
    public $from, $to, $appointment_duration, $department_id, $doctor_id;

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }

    public function mount()
    {
        $this->from = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->to = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->appointment_duration = 'morning';
    }

    public function render()
    {
        $morningTimesCount = 0;
        $eveningTimesCount = 0;
        $timesCount = 0;

        // $appointments = Appointment::where('appointment_status','pending')->get();
        $appointments = Appointment::where(function ($query) {
            $this->between($query);
        })->where(function ($q) {
            if ($this->department_id) {
                $q->where('clinic_id', $this->department_id);
            }
            if ($this->doctor_id) {
                $q->where('doctor_id', $this->doctor_id);
            }
        })->latest()->get();
        // $appointments = Appointment::all();
        $currentAppointments = Appointment::today()->where('appointment_status', 'pending')->get();


        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $reservedTimes = [];
        if ($this->appointment_duration == 'morning' or $this->appointment_duration == 'all') {
            for ($i = $from_morning; $i < $to_morning; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
                $morningTimesCount += 2;
            }

            $timesCount += $morningTimesCount;
        }
        if ($this->appointment_duration == 'evening' or $this->appointment_duration == 'all') {

            for ($i = $from_evening; $i < $to_evening; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
                $eveningTimesCount += 2;
            }

            $timesCount += $eveningTimesCount;
        }

        $availableTimes = ($timesCount * 7) - $appointments->count();
        $departments = Department::all();
        $doctors = User::doctors()->whereRelation('departments', 'departments.id', $this->department_id)->get();
        return view('livewire.appointments-info', compact('appointments', 'currentAppointments', 'times', 'availableTimes', 'departments', 'doctors'));
    }
}
