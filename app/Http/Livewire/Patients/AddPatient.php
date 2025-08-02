<?php

namespace App\Http\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\WhatsappMessageHandler;
use App\Models\Strain;

class AddPatient extends Component
{
    public  $first_name, $phone, $city_id, $age, $name, $gender, $strain_id,
        $category, $tax_number, $address, $street,
        $building_number, $postal_code, $email;

    public $strains = [];
    use WithFileUploads;

    protected function rules()
    {
        return [
            'first_name' => 'required',
            'phone' => 'required|numeric|unique:patients,phone',
            'email' => 'nullable|email|unique:patients,email',
            'city_id' => 'nullable',
            'tax_number' => 'nullable',
            'address' => 'nullable',
            'street' => 'nullable',
            'building_number' => 'nullable',
            'postal_code' => 'nullable',
            'category' => 'nullable',
            'name' => 'nullable',
            'gender' => 'nullable',
            'age' => 'nullable',
            'strain_id' => 'nullable',
        ];
    }

    public function updatedCategory()
    {

        $this->strains = Strain::where('category_id', $this->category)->get();
    }


    public function save()
    {
        $data =  $this->validate();
        // $data['user_id'] = auth()->id();
        // $data['department_id'] = 1;
        // $patient = Patient::create($data);
        $patient = Patient::create([
            'user_id' => auth()->id(),
            'first_name' => $this->first_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'city_id' => $this->city_id,
            'tax_number' => $this->tax_number,
            'address' => $this->address,
            'street' => $this->street,
            'building_number' => $this->building_number,
            'postal_code' => $this->postal_code,
        ]);
        if ($this->category != null) {
            $patient->animals()->create([
                'category_id' => $this->category,
                'name' => $this->name,
                'gender' => $this->gender,
                'age' => $this->age,
                'strain_id' => $this->strain_id,
            ]);
        }
        WhatsappMessageHandler::register($patient);

        if (auth()->user()->type == 'scan') {
            return redirect()->route('scan.patients.index')->with('success', __('Successfully added'));
        } elseif (auth()->user()->type == 'lab') {
            return redirect()->route('lab.patients.index')->with('success', __('Successfully added'));
        } elseif (auth()->user()->type == 'dr') {
            return redirect()->route('doctor.patients.index')->with('success', __('Successfully added'));
        } else {
            return redirect()->route('front.patients.index')->with('success', __('Successfully added'));
        }
    }

    public function render()
    {
        return view('livewire.patients.add-patient');
    }
}
