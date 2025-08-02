<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Department;
use App\Models\Appointment;
use App\Services\WhatsappMessageHandler;

class Appointments extends Component
{
    public $date, $dr, $period, $department, $transferred, $search, $appointment_status, $today_or_yasterday, $today;
    protected $queryString = ['today_or_yasterday'];
    public function mount($transferred = false)
    {
        $this->transferred = $transferred;
        $this->today = request('today');
    }

    public function render()
    {
        $appoints = Appointment::where(function ($q) {
            if ($this->date) {
                $q->where('appointment_date', $this->date);
            }
            if (request()->appointment_status) {
                $q->where('appointment_status', request()->appointment_status);
            }
            if ($this->dr) {
                $q->where('doctor_id', $this->dr);
            }
            if ($this->period) {
                $q->where('appointment_duration', $this->period);
            }
            if ($this->department) {
                $q->where('clinic_id', $this->department);
            }
            if ($this->search) {
                $q->whereHas(
                    'patient',
                    function ($q) {
                        $q->where('phone', 'like', '%' . $this->search . '%')
                            ->orWhere('id', '=', $this->search)->orWhere('first_name', 'like', '%' . $this->search . '%');
                    }
                );
            }
            if ($this->transferred) {
                $q->Transferred();
            }
            if ($this->today_or_yasterday) {
                $date = Carbon::now();
                $data = $this->today_or_yasterday == 'today' ? $date : ($this->today_or_yasterday == 'yesterday' ? $date->subDay() : $date->addDay());
                $q->whereDate('appointment_date', $data);
            }
        })->latest()->paginate(10);
        $departments = Department::all();
        $doctors = User::doctors()->where('department_id', $this->department)->get();
        return view('livewire.appointments', compact('appoints', 'departments', 'doctors'));
    }
    public function resetAll()
    {
        $this->reset('date', 'dr', 'period', 'department');
    }

    public function presence(Appointment $appointment)
    {
        $appointment->update(['attended_at' => Carbon::now(), 'appointment_status' => 'confirmed']);

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم تحضير المريض بنجاح']);
    }

    public function notPresence(Appointment $appointment)
    {
        $appointment->update(['appointment_status' => 'cancelled']);
        WhatsappMessageHandler::notify($appointment, 'cancel');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إلغاء حضور المريض بنجاح']);
    }

    public function cancelled(Appointment $appointment)
    {
        $appointment->update(['appointment_status' => 'cancelled']);
        WhatsappMessageHandler::notify($appointment, 'cancel');

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إلغاء الموعد بنجاح']);
    }

    public function examined(Appointment $appointment)
    {
        $appointment->update(['appointment_status' => 'examined']);

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم انتهاء الكشف بنجاح']);
    }
}
