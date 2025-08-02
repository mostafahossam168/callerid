<?php

namespace App\Http\Livewire\Patients;

use App\Models\Appointment;
use App\Models\Diagnose;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Queue;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Patients extends Component
{
    use WithPagination;
    public $civil;
    public $patient_id;
    public $phone;
    public $doctor_id;
    public $room_id;
    public $clinic_id;
    public $appointment_duration;
    public $transfer_mode = false;
    public $trans_patient;
    public $waiting;
    public $filter_visit;
    public $pressure_rate;
    public $breathing_rate;
    public $heart_rate;
    public $sugar_rate;
    public $temperature;
    public $patient_name;
    public $number_sim;
    protected $paginationTheme = 'bootstrap';
    // public function mount(Patient $patient)
    // {
    //     $this->trans_patient= $patient;
    // }

    protected function rules()
    {
        return [
            'doctor_id' => 'required',
            'appointment_duration' => 'required',
            'clinic_id' => 'required',
            'room_id' => 'nullable',
        ];
    }
    public function transfer(Patient $patient)
    {
        $this->trans_patient = null;
        if (!$patient->has_appoint_trans) {
            $this->trans_patient = $patient;
            $this->emit('trans_modal');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => __('The patient is already transferred')]);
        }
    }
    public function submit_transfer($print = null)
    {
        $data = $this->validate([
            'doctor_id' => 'required',
            'appointment_duration' => 'required',
            'clinic_id' => 'required',
            'room_id' => 'nullable',
            'sugar_rate' => 'nullable',
            'pressure_rate' => 'nullable',
            'breathing_rate' => 'nullable',
            'heart_rate' => 'nullable',
            'temperature' => 'nullable',
        ]);

        $data['patient_id'] = $this->trans_patient->id;
        $data['employee_id'] = auth()->id();
        $data['appointment_number'] = Str::random(10);
        $data['appointment_status'] = 'transferred';
        $data['appointment_time'] = date('H:i');
        $data['appointment_date'] = date('Y-m-d');

        unset($data['sugar_rate']);
        unset($data['pressure_rate']);
        unset($data['breathing_rate']);
        unset($data['heart_rate']);

        $appoint = Appointment::create($data);

        Queue::where('patient_id', $appoint->patient_id)->delete();

        Diagnose::create([
            'sugar_rate' => $this->sugar_rate,
            'pressure_rate' => $this->pressure_rate,
            'breathing_rate' => $this->breathing_rate,
            'heart_rate' => $this->heart_rate,
            'temperature' => $this->temperature,
            'time' => $appoint->appointment_time,
            'day' => $appoint->appointment_date,
            'period' => $appoint->appointment_duration,
            'appointment_id' => $appoint->id,
            'patient_id' => $appoint->patient_id,
            'dr_id' => $appoint->doctor_id,
            'department_id' => $appoint->clinic_id,
        ]);


        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('The patient has been successfully transferred')]);
        if ($print) {
            return redirect()->route('front.appointment.print-transfer', ['appointment' => $appoint, 'waiting' => $this->waiting]);
        }
        $this->reset();
    }
    public function delete(Patient $patient)
    {
        if ($patient->image) {
            delete_file($patient->image);
        }

        $patient->invoices()->delete();
        $patient->diagnoses()->delete();
        $patient->files()->delete();
        $patient->appointments()->delete();
        $patient->scanRequests()->delete();
        $patient->labRequests()->delete();
        Queue::where('patient_id', $patient->id)->delete();

        $patient->delete();

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function addToQueue($patient)
    {
        $patientInQueue = Queue::where('patient_id', $patient['id'])->first();
        if ($patientInQueue) {
            $patientInQueue->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('تم حذف المريض من قائمة الانتظار بنجاح')]);
            return;
        }
        Queue::create([
            'patient_id' => $patient['id'],
        ]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' =>  __('تمت إضافة المريض إلى قائمة الانتظار بنجاح')]);

        $this->reset();
    }

    public function render()
    {
        $this->waiting = \App\Models\Appointment::where('doctor_id', $this->doctor_id)
            ->Transferred()
            ->count() + 1;
        $patients = Patient::with(['country', 'user', 'invoices'])->withCount('animals')->where(function ($q) {
            if ($this->patient_id) {
                $q->where('id', $this->patient_id);
            }
            if ($this->civil) {
                $q->where('civil', 'LIKE', "%$this->civil%");
            }
            if ($this->patient_name) {
                $q->where('first_name', 'LIKE', "%$this->patient_name%");
            }
            if ($this->phone) {
                $q->where('phone', 'LIKE', "%$this->phone%");
            }
            if (request('toDay')) {
                $q->whereDate('created_at', toDay());
            }
            if (request('saudi') == true) {
                $q->where('country_id', 1);
            }
            if (request('saudi') == 'false') {
                $q->where('country_id', '<>', 1);
            }
            if ($this->filter_visit) {
                $q->where('visitor', true);
            }
            if ($this->number_sim){
                $q->whereHas('animals',function ($qq){
                    $qq->where('number_sim',$this->number_sim);
                });
            }
        })->latest()->paginate(10);
        return view('livewire.patients.patients', compact('patients'));
    }
}
