<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use Livewire\WithFileUploads;

class EditPatient extends Component
{
    public $patient, $first_name, $city_id, $phone, $tax_number, $address, $street, $building_number, $postal_code, $email;

    use WithFileUploads;

    protected function rules()
    {
        return [
            'first_name' => 'required',
            'phone' => 'required|numeric|unique:patients,phone,' . $this->patient->id,
            'email' => 'nullable|email|unique:patients,phone,' . $this->patient->id,
            'city_id' => 'nullable',
            'tax_number' => 'nullable',
            'address' => 'nullable',
            'street' => 'nullable',
            'building_number' => 'nullable',
            'postal_code' => 'nullable',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $data = $this->validate();
        $data['user_id'] = $this->patient->user_id;
        //        $data['department_id'] = 1;

        $this->patient->update($data);
        return redirect()->route('front.patients.index')->with('success', __('Successfully updated'));
    }

    public function mount($patient)
    {
        $this->patient = $patient;
        $this->first_name = $patient->first_name;
        $this->phone = $patient->phone;
        $this->email = $patient->email;
        $this->city_id = $patient->city_id;
        $this->tax_number = $patient->tax_number;
        $this->address = $patient->address;
        $this->street = $patient->street;
        $this->building_number = $patient->building_number;
        $this->postal_code = $patient->postal_code;
    }

    public function render()
    {
        return view('livewire.patients.edit-patient');
    }
}
