<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateGuests extends Component
{
    public $civil, $first_name,  $gender, $phone , $doctor_id , $clinic_id , $appointment_time , $appointment, $appointment_date;
    use WithFileUploads;

    protected function rules()
    {
        return [
            'civil' => 'nullable|numeric|digits:10|unique:patients,civil',
            'first_name' => 'required',
            'phone' => 'required|unique:patients,phone',
            'gender' => 'required|in:male,female',
            'doctor_id' => 'required',
            'clinic_id' => 'required',
            'appointment_time' => 'required',
            'appointment_date' => 'required',
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $data=$this->validate();
      // $patient =  Patient::create($data);
       $patient = new Patient();
        $patient->civil = $this->civil?$this->civil:'-';
        $patient->first_name = $this->first_name;
        $patient->phone = $this->phone;
        $patient->gender = $this->gender;
        $patient->visitor = 1;
        $patient->user_id = auth()->id();
        $patient->save();

        $this->appointment['doctor_id'] = $this->doctor_id;
        $this->appointment['clinic_id'] = $this->clinic_id;
        $this->appointment['appointment_date'] = $this->appointment_date;
        $this->appointment['appointment_time'] = $this->appointment_time;
        $this->appointment['appointment_status'] = 'pending';
        $this->appointment['employee_id'] = auth()->user()->id;
        $this->appointment['patient_id'] = $patient->id;
        $this->appointment['appointment_number'] = Str::random(10);
        Appointment::query()->create($this->appointment);
        return redirect()->route('front.appointments.index')->with('success', __('Successfully added'));
    }
    public function updatedInsurance(){
        $this->insurance_id=null;
    }
    public function render()
    {
        return view('livewire.create-guests');
    }
}
