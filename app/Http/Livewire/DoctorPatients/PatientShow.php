<?php

namespace App\Http\Livewire\DoctorPatients;

use Livewire\Component;

class PatientShow extends Component
{
    public $patient;
    public function render()
    {
        return view('livewire.doctor-patients.patient-show');
    }
}
