<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Product;
use Livewire\Component;
use App\Models\Department;
use App\Models\Appointment;
use Illuminate\Support\Str;
use App\Models\Notification;
use App\Services\WhatsappMessageHandler;

class AppointmentForm extends Component
{
    public $appointment, $noResults, $appointment_id, $patient, $patient_id, $doctor_id, $room_id, $clinic_id, $appointment_date, $appointment_time, $appointment_status, $appointment_duration, $patient_key, $animal_id, $product_id;
    public function rules()
    {
        return [
            'patient' => 'required',
            'doctor_id' => 'nullable',
            'clinic_id' => 'nullable',
            'product_id' => 'nullable',
            'room_id' => 'nullable',
            'appointment_date' => 'nullable',
            'appointment_time' => 'nullable',
            'appointment_duration' => 'nullable',
            'appointment_status' => 'nullable',
            'animal_id' => 'nullable'
        ];
    }
    // public function get_patient()
    // {
    //     $this->patient = Patient::where('phone', $this->patient_key)->orWhere('civil', $this->patient_key)->orWhere('first_name', 'LIKE', "%$this->patient_key%")->first();
    //     if ($this->patient) {
    //         $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
    //         if ($this->patient->invoices()->unpaid()->count() > 0) {
    //             $this->emit('sss');
    //         }
    //     } else {
    //         $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
    //     }
    // }
    public function get_patient()
    {
        if (empty($this->patient_key)) {
            // إذا كانت البحث فارغة، قم بمسح البيانات
            $this->patient = null;
            // $this->noResults = false; // تأكد من عدم ظهور رسالة "لم يتم العثور على نتائج"
            return;
        }

        $this->patient = Patient::where('phone', $this->patient_key)
            ->orWhere('civil', $this->patient_key)
            ->orWhere('first_name', 'LIKE', "%$this->patient_key%")
            ->first();

        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
            if ($this->patient->invoices()->unpaid()->count() > 0) {
                $this->emit('sss');
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
    }






    public function save()
    {

        if ($this->patient) {


            // check if there is an appointment with the same doctor and patient
            /* $appointment = Appointment::where('doctor_id', $this->doctor_id)
            ->where('patient_id', $this->patient->id)
            ->where('appointment_status', 'pending')
            ->first();
            if ($appointment) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'هناك موعد بهذا الطبيب لهذا المريض']);
            return;
            } */

            // check if there is an appointment with the same date and time
            /* $appointment = Appointment::where('appointment_date', $this->appointment_date)
            ->where('appointment_time', $this->appointment_time)
            ->first();
            if ($appointment) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'هناك موعد بهذا التاريخ والوقت']);
            return;
            } */

            // check if there is an appointment with the same room
            /* $appointment = Appointment::where('room_id', $this->room_id)->where('appointment_date', $this->appointment_date)
            ->where('appointment_time', $this->appointment_time)
            ->first();
            if ($appointment) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'هناك موعد بهذا التاريخ والوقت لنفس الغرفة']);
            return;
            } */

            if (setting()->from_morning || setting()->from_evening) {

                $data = $this->validate();
                unset($data['patient']);
                $data['employee_id'] = auth()->id();
                $data['patient_id'] = $this->patient->id;
                $data['appointment_status'] = Carbon::parse($this->appointment_date)->format('Y-m-d') > today()->format('Y-m-d') ? 'confirmed' : 'pending';
                if ($this->appointment?->id) {
                    $this->appointment->update($data);
                } else {
                    $data['appointment_number'] = Str::random(10);

                    $appointment = Appointment::create($data);
                    WhatsappMessageHandler::notify($appointment, 'create');
                }

                $user = User::find($data['doctor_id']);
                $title = 'تم اضافة موعد جديد';
                $link = route('doctor.appointments');
                Notification::send($user->id, $title, $link, 'appointment');

                session()->flash('success', __('Saved successfully'));
                return redirect()->route('front.appointments.index');
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'يجب تحديد المواعيد من الاعدادات أولاً']);
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'يجب تحديد المريض أولا']);
        }
    }

    public function mount($appointment = null)
    {
        $appointment = Appointment::find($appointment?->id);
        $this->appointment = $appointment;
        $this->patient = $appointment ? $appointment->patient : null;
        $this->patient_id = $appointment ? $appointment->patient_id : null;
        $this->doctor_id = $appointment ? $appointment->doctor_id : null;
        $this->clinic_id = $appointment ? $appointment->clinic_id : null;
        $this->room_id = $appointment ? $appointment->room_id : null;
        $this->animal_id = $appointment->animal_id ?? null;
        $this->appointment_status = $appointment ? $appointment->appointment_status : null;
        $this->appointment_duration = $appointment
            ? $appointment->appointment_duration
            : (request()->has('appointment_duration') ? request()->appointment_duration : null);
        $this->appointment_date = $appointment
            ? $appointment->appointment_date
            : (request()->has('appointment_date') ? request()->appointment_date : now()->format('Y-m-d'));
        $this->appointment_time = $appointment
            ? Carbon::parse($appointment->appointment_time)->format('h:i')
            : (request()->has('appointment_time') ? Carbon::createFromTime(request()->appointment_time)->format('h:i') : now()->format('H:i'));

        // dd($appointment, $appointment?->appointment_duration, (request()->has('appointment_duration') ? request()->appointment_duration : null));
    }
    public function render()
    {
        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $reservedTimes = [];
        $doctor = User::find($this->doctor_id);
        if ($this->appointment_duration == 'morning') {
            $diffInMinutes = Carbon::parse(setting()->from_morning)->diffInMinutes(Carbon::parse(setting()->to_morning));
            $last_time = $diffInMinutes / 30;
            $start = Carbon::createFromTime($from_morning, 0, 0);
            $times = [];
            $times[] = $start->format('H:i');
            for ($i = 1; $i < ($last_time + 1); $i++) { // add 1 to fix missing 1 min in morning duration
                $time = $start->addMinutes(30);
                $times[] = $time->format('H:i');
            }
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                ->where('appointment_time', '>=', $from_morning)
                ->where('appointment_time', '<=', $to_morning)
                ->where(function ($q) {
                    if ($this->appointment) {
                        $q->where('id', '!=', $this->appointment->id);
                    }
                })
                ->pluck('appointment_time')->toArray();
        } elseif ($this->appointment_duration == 'evening') {
            $diffInMinutes = Carbon::parse(setting()->from_evening)->diffInMinutes(Carbon::parse(setting()->to_evening));
            $last_time = $diffInMinutes / 30;
            $start = Carbon::createFromTime($from_evening, 0, 0);
            $times = [];
            $times[] = $start->format('H:i');
            for ($i = 1; $i < ($last_time + 1); $i++) { // add 1 to fix missing 1 min in morning duration
                $time = $start->addMinutes(30);
                $times[] = $time->format('H:i');
            }
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                ->where('appointment_time', '>=', $from_evening)
                ->where('appointment_time', '<=', $to_evening)
                ->where(function ($q) {
                    if ($this->appointment) {
                        $q->where('id', '!=', $this->appointment->id);
                    }
                })
                ->pluck('appointment_time')->toArray();
        }

        $products = Product::where('department_id', $this->clinic_id)->get();

        return view('livewire.appointment-form', compact('reservedTimes', 'times', 'products'));
    }
}
