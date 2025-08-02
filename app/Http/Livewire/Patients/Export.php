<?php

namespace App\Http\Livewire\Patients;

use App\Exports\PatientByAppointsExport;
use App\Models\Patient;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class Export extends Component
{
    public $from,$to,$gender;
    public Collection $patients_export;
    public function between($query,$column)
    {
        if ($this->from && $this->to) {
            $query->whereBetween($column, [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where($column, '>=', $this->from);
        } elseif ($this->to) {
            $query->where($column, '<=', $this->to);
        } else {
            $query;
        }
    }
    public function export() 
    {
        return Excel::download(new PatientByAppointsExport($this->patients_export), 'patients'.time().'.xlsx');
    }
    public function render()
    {
        $patients=collect();
        if($this->from or $this->to){

        $patients = Patient::where(function($q){
            if($this->gender){
                $q->where('gender',$this->gender);
            }
            if($this->from or $this->to){
                $q->whereHas('appointments',function($a){
                    $this->between($a,'appointment_date');
                });
            }
        })->latest()->get();
    }

        $this->patients_export=$patients;
        return view('livewire.patients.export',compact('patients'));
    }
}
