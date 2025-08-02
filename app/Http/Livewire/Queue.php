<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Patient;
use App\Models\Queue as ModelsQueue;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;

class Queue extends Component
{


    public $patient,$animals,$patient_id, $trans_patient, $clinic_id, $waiting, $appointment_duration, $room_id, $doctor_id;
    public $sugar_rate ,$pressure_rate ,$breathing_rate,$heart_rate,$animal_id,$patient_key;
    protected function rules()
    {
        return [
            'doctor_id' => 'required',
            'appointment_duration' => 'required',
            'clinic_id' => 'required',
            'room_id' => 'nullable',
        ];
    }

    public function get_patient()
    {
        $this->patient = Patient::where('id', $this->patient_key)
            ->orWhere('phone', $this->patient_key)
            ->first();
        if ($this->patient) {
            // dd($this->patient);
            $this->patient_id=$this->patient->id;
            $this->animals=$this->patient->animals;
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
    }
    public function addToQueue()
    {
        if(!$this->patient or !$this->animal_id){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' =>  'يرجى اختيار المالك والحيوان']);
            return;
        }
        $patient = ModelsQueue::where('patient_id', $this->patient_id)->where('animal_id', $this->animal_id)->first();
        if ($patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' =>  __('This patient is already in the queue')]);
            return;
        }
        ModelsQueue::create([
            'patient_id' => $this->patient_id,
            'animal_id' => $this->animal_id,
        ]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' =>  __('تمت إضافة المريض إلى قائمة الانتظار بنجاح')]);

        $this->reset();
    }

    public function transfer(Patient $patient,ModelsQueue $queue=null)
    {
        $this->trans_patient = null;
        if (!$patient->has_appoint_trans) {
            $this->trans_patient = $patient;
            $this->animal_id = $queue->animal_id;
            $this->emit('trans_modal');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => __('The patient is already transferred')]);
        }
    }

    public function submit_transfer($print = null)
    {

        $data = $this->validate();

        $data['patient_id'] = $this->trans_patient->id;
        $data['employee_id'] = auth()->id();
        $data['appointment_number'] = Str::random(10);
        $data['appointment_status'] = 'transferred';
        $data['appointment_time'] = date('H:i');
        $data['appointment_date'] = date('Y-m-d');
        $data['animal_id'] = $this->animal_id;
        $appoint = Appointment::create($data);
        ModelsQueue::where('patient_id',$this->trans_patient->id)->where('animal_id',$this->animal_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('The patient has been successfully transferred')]);
        if ($print) {
            return redirect()->route('front.appointment.print-transfer', ['appointment' => $appoint, 'waiting' => $this->waiting]);
        }
        $this->reset();
    }

    public function delete($id)
    {
        ModelsQueue::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('تم حذف المريض من قائمة الانتظار بنجاح')]);
    }

    public function render()
    {
        // oldest first
        $patients = Patient::all();
        $queue = ModelsQueue::with('patient')->orderBy('created_at', 'asc')->get();
        $todayQueue = ModelsQueue::with('patient')->today()->orderBy('created_at', 'asc')->get();
        return view('livewire.queue', compact('queue', 'patients','todayQueue'));
    }
}
