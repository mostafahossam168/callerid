<?php

namespace App\Http\Livewire\DoctorPatients;

use Livewire\Component;
use App\Models\Diagnose;
use App\Models\Medicine;
use App\Models\Appointment;
use App\Models\PatientFile;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\PharmacyRequest;

class ViewPatient extends Component
{
    public $patient, $screen = 'data', $invoice_status, $file, $file_name;

    public $penicillin, $teeth_problems, $drugs, $heart, $pressure, $fever, $anemia, $thyroid_glands, $liver, $sugar, $tb, $kidneys, $convulsion, $other_diseases, $image, $date, $insurance_id, $insurance, $is_pregnant;

    public $taken, $treatment, $sugar_rate, $pressure_rate, $age, $weight, $temperature, $pulse_rate, $breathing_rate, $blood_pressure, $sugar_measurement, $head_and_neck, $belly, $chest_and_back, $upper_lower_extremities, $pelvis, $vaccinations = [], $sensitivity = [];

    public $all_drugs = [], $selected_drugs = [], $drug_key, $searched_drugs, $dr_content;
    public $drug_id = [];

    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    use WithFileUploads;
    protected function rules()
    {
        return [
            'file_name' => 'required',
            'file' => 'required',
        ];
    }

    public function resetInputs()
    {
        $this->reset(['selected_drugs', 'dr_content']);
    }


    public function mount()
    {

        $appointment = Appointment::where('patient_id', $this->patient->id)->latest()->first();
        $diagnose = null;
        if ($appointment) {
            $diagnose = Diagnose::where('appointment_id', $appointment->id)->where('patient_id', $this->patient->id)->first();
        }

        $this->all_drugs = Medicine::all();
        $this->penicillin = $this->patient->penicillin;
        $this->teeth_problems = $this->patient->teeth_problems;
        $this->drugs = $this->patient->drugs;
        $this->heart = $this->patient->heart;
        $this->pressure = $this->patient->pressure;
        $this->fever = $this->patient->fever;
        $this->anemia = $this->patient->anemia;
        $this->thyroid_glands = $this->patient->thyroid_glands;
        $this->liver = $this->patient->liver;
        $this->sugar = $this->patient->sugar;
        $this->tb = $this->patient->tb;
        $this->kidneys = $this->patient->kidneys;
        $this->convulsion = $this->patient->convulsion;
        $this->other_diseases = $this->patient->other_diseases;
        $this->is_pregnant = $this->patient->is_pregnant;
        $this->fluidity = $this->patient->fluidity;
        $this->aids = $this->patient->aids;
        $this->strokes = $this->patient->strokes;
        $this->tuberculosis = $this->patient->tuberculosis;
        $this->epilepsy = $this->patient->epilepsy;
        $this->psychiatric = $this->patient->psychiatric;
        $this->cancer = $this->patient->cancer;
        $this->eating_meat = $this->patient->eating_meat;
        $this->fruits_and_vegetables = $this->patient->fruits_and_vegetables;
        $this->smoking = $this->patient->smoking;
        $this->other_habits = $this->patient->other_habits;

        if ($diagnose) {
            $this->sugar_rate = $diagnose->sugar_rate;
            $this->pressure_rate = $diagnose->pressure_rate;
            $this->age = $diagnose->age;
            $this->weight = $diagnose->weight;
        }

        $this->vaccinations = [
            ['']
        ];

        $this->sensitivity = [
            ['']
        ];
    }

    public function addNewVaccination()
    {
        $this->vaccinations[] = [''];
    }

    public function addNewSensitivity()
    {
        $this->sensitivity[] = [''];
    }

    public function removeVaccination($index)
    {
        unset($this->vaccinations[$index]);
        $this->vaccinations = array_values($this->vaccinations);
    }

    public function removeSensitivity($index)
    {
        unset($this->sensitivity[$index]);
        $this->sensitivity = array_values($this->sensitivity);
    }

    public function save_file()
    {
        $data = $this->validate();
        $data['patient_id'] = $this->patient->id;
        $data['file_path'] = store_file($this->file, 'patients_file');
        $data['file_type'] = $this->file->getExtension();
        $data['file_size'] = $this->file->getSize();
        $data['employee_id'] = auth()->id();
        unset($data['file']);
        PatientFile::create($data);
        $this->reset(['file_name', 'file']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function delete_file(PatientFile $file)
    {
        $file->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $invoices = $this->patient->invoices()->with(['dr', 'employee'])->where(function ($q) {
            if ($this->invoice_status) {
                $q->where('status', $this->invoice_status);
            }
        })->latest()->paginate(5);
        $appoints = $this->patient->appointments()->with(['clinic', 'doctor'])->latest()->paginate(5);
        $diagnoses = $this->patient->diagnoses()->with(['department', 'dr'])->latest()->paginate(5);
        $files = $this->patient->files()->with(['patient', 'employee'])->latest()->paginate(5);
        $scanRequests = $this->patient->scanRequests()->with(['patient', 'doctor'])->latest()->paginate(5);
        $labRequests = $this->patient->labRequests()->with(['patient', 'doctor'])->latest()->paginate(5);
        return view('livewire.doctor-patients.view-patient', compact('labRequests', 'scanRequests', 'invoices', 'appoints', 'diagnoses', 'files'));
    }

    public function saveDiagnose()
    {
        $data = $this->validate([
            'taken' => 'required',
            'treatment' => 'required',
            'sugar_rate' => 'nullable',
            'pressure_rate' => 'nullable',
            'weight' => 'nullable',
            'age' => 'nullable',
            'temperature' => 'nullable',
            'pulse_rate' => 'nullable',
            'breathing_rate' => 'nullable',
            'blood_pressure' => 'nullable',
            'sugar_measurement' => 'nullable',
            'head_and_neck' => 'nullable',
            'belly' => 'nullable',
            'chest_and_back' => 'nullable',
            'upper_lower_extremities' => 'nullable',
            'pelvis' => 'nullable',
            'vaccinations' => 'nullable',
            'sensitivity' => 'nullable',
        ]);

        $appointment = Appointment::where('patient_id', $this->patient->id)->latest()->first();

        $diagnose = Diagnose::where('appointment_id', $appointment->id)->where('patient_id', $this->patient->id)->first();

        if ($diagnose) {
            $diagnose->update([
                'appointment_id' => $appointment->id,
                'patient_id' => $this->patient->id,
                'dr_id' => doctor()->id,
                'department_id' => doctor()->department_id,
                'time' => date('H:i'),
                'day' => date('Y-m-d'),
                'period' => $appointment->appointment_duration,
                'taken' => $this->taken,
                'treatment' => $this->treatment,
                'sugar_rate' => $this->sugar_rate,
                'pressure_rate' => $this->pressure_rate,
                'age' => $this->age,
                'weight' => $this->weight,
                'temperature' => $this->temperature,
                'pulse_rate' => $this->pulse_rate,
                'breathing_rate' => $this->breathing_rate,
                'blood_pressure' => $this->blood_pressure,
                'sugar_measurement' => $this->sugar_measurement,
                'head_and_neck' => $this->head_and_neck,
                'belly' => $this->belly,
                'chest_and_back' => $this->chest_and_back,
                'upper_lower_extremities' => $this->upper_lower_extremities,
                'pelvis' => $this->pelvis,
                'vaccinations' => $this->vaccinations,
                'sensitivity' => $this->sensitivity,
            ]);
        }
        else {

            Diagnose::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $this->patient->id,
                'dr_id' => doctor()->id,
                'department_id' => doctor()->department_id,
                'time' => date('H:i'),
                'day' => date('Y-m-d'),
                'period' => $appointment->appointment_duration,
                'taken' => $this->taken,
                'treatment' => $this->treatment,
                'sugar_rate' => $this->sugar_rate,
                'pressure_rate' => $this->pressure_rate,
                'age' => $this->age,
                'weight' => $this->weight,
                'temperature' => $this->temperature,
                'pulse_rate' => $this->pulse_rate,
                'breathing_rate' => $this->breathing_rate,
                'blood_pressure' => $this->blood_pressure,
                'sugar_measurement' => $this->sugar_measurement,
                'head_and_neck' => $this->head_and_neck,
                'belly' => $this->belly,
                'chest_and_back' => $this->chest_and_back,
                'upper_lower_extremities' => $this->upper_lower_extremities,
                'pelvis' => $this->pelvis,
                'vaccinations' => $this->vaccinations,
                'sensitivity' => $this->sensitivity,
            ]);
        }

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function updatePatient()
    {
        $this->patient->update([
            'penicillin' => $this->penicillin,
            'teeth_problems' => $this->teeth_problems,
            'drugs' => $this->drugs,
            'heart' => $this->heart,
            'pressure' => $this->pressure,
            'fever' => $this->fever,
            'anemia' => $this->anemia,
            'thyroid_glands' => $this->thyroid_glands,
            'liver' => $this->liver,
            'sugar' => $this->sugar,
            'tb' => $this->tb,
            'kidneys' => $this->kidneys,
            'convulsion' => $this->convulsion,
            'other_diseases' => $this->other_diseases,
            'is_pregnant' => $this->is_pregnant,
            'fluidity' => $this->fluidity,
            'aids' => $this->aids,
            'strokes' => $this->strokes,
            'tuberculosis' => $this->tuberculosis,
            'epilepsy' => $this->epilepsy,
            'psychiatric' => $this->psychiatric,
            'cancer' => $this->cancer,
            'eating_meat' => $this->eating_meat,
            'fruits_and_vegetables' => $this->fruits_and_vegetables,
            'smoking' => $this->smoking,
            'other_habits' => $this->other_habits,
        ]);

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    //updatedServiceId
    public function updatedDrugKey()
    {
        if ($this->drug_key) {
            $this->searched_drugs = Medicine::where('name_ar', 'LIKE', "%$this->drug_key%")->orWhere('name_en', 'LIKE', "%$this->drug_key%")->take(10)->get();
        }
    }
    public function selectDrug(Medicine $drug)
    {
        if ($drug) {

            $newArr = array_filter($this->selected_drugs, function ($item) use ($drug) {
                return $item['id'] == $drug->id;
            });

            if (count($newArr) > 0) {
                $key = array_keys($newArr)[0];
                ++$this->selected_drugs[$key]['quantity'];

                $this->selected_drugs[$key]['name_ar'] = $drug->name_ar;
            }
            else {

                $this->selected_drugs[] = [
                    'id' => $drug->id, 'name_ar' => $drug->name_ar, 'quantity' => 1
                ];
            }
        }
    }

    // drug_request
    public function drug_request()
    {

        $drugsIds = collect($this->selected_drugs)->pluck('id')->toArray();
        $drugsQtys = collect($this->selected_drugs)->pluck('quantity')->toArray();

        //dd(array_combine($drugsIds, $drugsQtys));
        $data = [
            'doctor_id' => doctor()->id,
            'patient_id' => $this->patient->id,
            'clinic_id' => doctor()->department->id,
            'drugs' => array_combine($drugsIds, $drugsQtys),
            'drugs_quantity' => $drugsQtys,
            'notes' => $this->dr_content,
            'status' => 'pending'
        ];
        /* foreach ($this->selected_drugs as $drug) {
         $data['drugs']= array($drug['id']);
         } */

        PharmacyRequest::create($data);

        //$res = Http::post(env('PHARMACY_API_URL') . '/drug-request', $data);
        //Debugbar::info($res->body());

        $this->resetInputs();

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إرسال طلب الأدوية بنجاح']);
    }
}
