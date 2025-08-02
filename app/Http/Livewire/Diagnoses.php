<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Diagnose;
use App\Models\Department;
use Livewire\WithPagination;

class Diagnoses extends Component
{
    public $filter_dr, $filter_phone, $filter_patient, $filter_depart, $dr_id, $patient_id, $department_id, $tooth, $taken, $treatment, $appointment_id, $time, $day, $period, $diagnose;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function rules()
    {
        return [
            'dr_id' => 'required',
            'patient_id' => 'required',
            'department_id' => 'required',
            'tooth' => 'required',
            'treatment' => 'required',
            'taken' => 'required',
            'appointment_id' => 'required',
            'time' => 'required',
            'day' => 'required',
            'period' => 'required',
        ];
    }

    // public function edit(Diagnose $diagnose)
    // {

    //     $this->tooth = $diagnose->tooth;
    //     $this->treatment = $diagnose->treatment;
    //     $this->taken = $diagnose->taken;
    //     $this->dr_id = $diagnose->dr_id;
    //     $this->department_id = $diagnose->department_id;
    //     $this->patient_id = $diagnose->patient_id;
    //     $this->period = $diagnose->period;
    //     $this->time = $diagnose->time;
    //     $this->day = $diagnose->day;
    //     $this->appointment_id = $diagnose->appointment_id;
    //     $this->diagnose = $diagnose;
    // }

    // public function save()
    // {
    //     $data = $this->validate();
    //     $this->diagnose->update($data);
    //     $this->reset();
    //     $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully updated')]);
    // }

    public function delete(Diagnose $diagnose)
    {
        $diagnose->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }
    public function render()
    {
        $diagnoses = Diagnose::with(['appoint', 'dr', 'patient'])->where(function ($q) {
            if ($this->filter_dr) {
                $q->where('dr_id', $this->filter_dr);
            }
            if ($this->filter_patient) {
                $q->where('patient_id', $this->filter_patient);
            }
            if ($this->filter_phone) {
                // $q->whereRelation('patient', 'phone', $this->filter_patient);
                $q->whereRelation('patient', 'phone', 'like', '%' . $this->filter_phone . '%');
            }
            // if ($this->filter_depart) {
            //     $q->where('department_id', $this->filter_depart);
            // }
        })->latest()->paginate(10);
        // $departments = Department::all();
        $doctors = User::doctors()->get();
        return view('livewire.diagnoses', compact('diagnoses', 'doctors'));
    }

    // public function show(Diagnose $diagnose)
    // {
    //     $this->edit($diagnose);
    //     $this->screen = 'show';
    // }
}