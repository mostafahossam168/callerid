<?php

namespace App\Http\Livewire\Animals;

use App\Models\User;
use App\Models\Queue;
use App\Models\Animal;
use App\Models\Strain;
use Livewire\Component;
use App\Models\Category;
use App\Models\Diagnose;
use App\Models\Appointment;
use Illuminate\Support\Str;
use App\Models\Notification;
use App\Traits\livewireResource;

class Patient extends Component
{
    public $name, $user_id, $category_id, $gender, $patient_id, $doctor_id, $breed_type, $age, $type, $strain_id;

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
    public $patient;
    public $weight;
    public $number_sim;

    public $selectedItems = [];
    public $all_animals = [];
    public $transfered_animals = [];

    use livewireResource;

    public function rules()
    {
        return [
            'name' => 'nullable',
            'category_id' => 'required',
            'gender' => 'nullable',
            'age' => 'nullable',
            'type' => 'nullable',
            // 'breed_type' => 'nullable',
            'strain_id' => 'nullable',
            'user_id' => 'nullable',
            'number_sim' => 'nullable'
            // $data['user_id'] = auth()->id();

        ];
    }


    public function beforeSubmit()
    {
        $this->data['patient_id'] = $this->patient->id;
        // $this->data['user_id'] = $this->auth()->id();
        $this->data['user_id'] = auth()->id();

    }

    public function mount($patient)
    {
        $this->patient = $patient;
        $this->model = 'App\Models\Animal';
    }

    public function addToQueue($patient, $animal)
    {
        $patientInQueue = Queue::where('patient_id', $patient['id'])->where('animal_id', $animal)->first();
        if ($patientInQueue) {
            $patientInQueue->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('تم حذف المريض من قائمة الانتظار بنجاح')]);
            return;
        } else {
            Queue::create([
                'patient_id' => $patient['id'],
                'animal_id' => $animal,
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('تمت إضافة المريض إلى قائمة الانتظار بنجاح')]);
        }


        // $this->reset();
    }
//     public function addToQueue($patientId)
// {
//     $patientInQueue = Queue::where('patient_id', $patientId)->first();

//     if ($patientInQueue) {
//         $patientInQueue->delete();
//         $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('تم حذف المريض من قائمة الانتظار بنجاح')]);
//     } else {
//         Queue::create([
//             'patient_id' => $patientId,
//         ]);

//         $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('تمت إضافة المريض إلى قائمة الانتظار بنجاح')]);
//     }
// }


    public function toggleItem($itemId)
    {
        if (in_array($itemId, $this->selectedItems)) {
            $this->selectedItems = array_diff($this->selectedItems, [$itemId]);
        } else {
            $this->selectedItems[] = $itemId;
        }
    }

    public function getTransferedAnimals()
    {
        $this->transfered_animals = Animal::whereIn('id', $this->selectedItems)->get()->toArray();
    }

    public function render()
    {

        $patient = $this->patient;
        $categories = Category::all();
        $strains = Strain::all();
        if ($this->doctor_id) {
            $this->waiting = Appointment::where('doctor_id', $this->doctor_id)
                    ->whereIn('appointment_status', ['transferred'])
                    ->count() + 1;
        }


        $animals = Animal::where(function ($q) {
            if ($this->patient) {
                $q->where('patient_id', $this->patient?->id);
            }
        })->latest()->paginate(10);
        // dd($animals);
        return view('livewire.animals.patient', compact('animals', 'categories', 'strains'));
    }

    public function transfer(Animal $animal)
    {
        $this->trans_patient = null;
        $this->trans_patient = $animal;
        $this->emit('trans_modal');
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

        $data['patient_id'] = $this->trans_patient->patient_id;
        $data['animal_id'] = $this->trans_patient->id;
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
            'age' => $this->age,
            'weight' => $this->weight,
        ]);

        $user = User::find($data['doctor_id']);
        $title = 'تم تحويل مريض جديد';
        $link = route('doctor.interface');
        // Notification::send($user->id, $title, $link, 'transfered');

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('The patient has been successfully transferred')]);
        if ($print) {
            return redirect()->route('front.appointment.print-transfer', ['appointment' => $appoint, 'waiting' => $this->waiting]);
        }
    }

    public function transfer_all($print = null)
    {
        // dd($this->transfered_animals);
        $data = $this->validate([
            'doctor_id' => 'required',
            'appointment_duration' => 'required',
            'clinic_id' => 'required',
        ]);
        // dd($this->transfered_animals);
        foreach ($this->transfered_animals as $key => $animal) {
            $data['patient_id'] = $animal['patient_id'];
            $data['animal_id'] = $animal['id'];
            $data['employee_id'] = auth()->id();
            $data['appointment_number'] = Str::random(10);
            $data['appointment_status'] = 'transferred';
            $data['appointment_time'] = date('H:i');
            $data['appointment_date'] = date('Y-m-d');

            // unset($data['sugar_rate']);
            // unset($data['pressure_rate']);
            // unset($data['breathing_rate']);
            // unset($data['heart_rate']);

            $appoint = Appointment::create($data);

            Queue::where('patient_id', $appoint->patient_id)->delete();

            // Diagnose::create([
            //     'sugar_rate' => $animal['sugar_rate'] ?? null,
            //     'pressure_rate' => $animal['pressure_rate'] ?? null,
            //     'breathing_rate' => $animal['breathing_rate'] ?? null,
            //     'heart_rate' => $animal['heart_rate'] ?? null,
            //     'temperature' => $animal['temperature'] ?? null,
            //     'time' => $appoint->appointment_time,
            //     'day' => $appoint->appointment_date,
            //     'period' => $appoint->appointment_duration,
            //     'appointment_id' => $appoint->id,
            //     'patient_id' => $appoint->patient_id,
            //     'dr_id' => $appoint->doctor_id,
            //     'department_id' => $appoint->clinic_id,
            //     'age' => $animal['animal_age'] ?? null,
            //     'weight' => $animal['weight'] ?? null,
            // ]);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('The patient has been successfully transferred')]);
        if ($print) {
            return redirect()->route('front.appointment.print-transfer', ['appointment' => $appoint, 'waiting' => $this->waiting]);
        }
    }

    public function delete(Animal $patient)
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

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }
}
