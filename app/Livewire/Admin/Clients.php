<?php

namespace App\Livewire\Admin;

use App\Exports\ClientsExport;
use App\Models\City;
use App\Models\Country;
use App\Models\Level;
use App\Models\Notification;
use App\Models\NotificationLibrary;
use App\Models\Program;
use App\Models\Region;
use App\Models\State;
use App\Models\User;
use App\Models\ContactName;
use App\Models\WhatsappMessage;
use App\Services\FCMService;
use App\Services\Whatsapp;
use App\Traits\livewireResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;


class Clients extends Component
{
    use livewireResource, WithFileUploads;

    public $name, $phone, $city_id, $type = 'client', $notes, $search, $cities, $filter_country,
        $programs, $possibleCients, $interestedCients,
        $notInterestedCients, $trueCients, $filter_active,
        $filter_city, $filter_program, $users, $filter_user,
        $client, $message, $image, $address, $pst, $contact, $class, $email, $status, $active, $password;
    public $country_id, $state_id, $level_id, $region, $library_id;

    public Collection $allClients;

    public function setModelName()
    {
        $this->model = 'App\Models\User';
    }

    public function export()
    {
        return Excel::download(new ClientsExport($this->allClients), 'clients' . time() . '.xlsx');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => ['required', 'unique:users,phone,' . $this->obj?->id],
            'email' => ['nullable', 'unique:users,email,' . $this->obj?->id],
            'country_id' => 'required',
            // 'state_id' => 'required',
            // 'region' => 'required',
            // 'city_id' => 'required',
            // 'level_id' => 'nullable',
            // 'notes' => 'nullable',
            // 'address' => 'nullable',
            // 'pst' => 'nullable',
            // 'contact' => 'nullable',
            // 'class' => 'nullable',
            'type' => 'nullable',
            'password' => 'required_without:obj',
            'active' => 'nullable'
        ];
    }

    public function toggle($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();
    }

    public function mount()
    {
        $this->cities = City::query()->get() ?? [];
        $this->programs = Program::all();
        $this->allClients = User::where('type', 'client')->get();
        $this->users = User::all();
        //        $this->possibleCients = Client::where('status', 'possible')->count();
        //        $this->interestedCients = Client::where('status', 'interested')->count();
        //        $this->notInterestedCients = Client::where('status', 'not_interested')->count();
        //        $this->trueCients = Client::where('status', 'true')->count();
        if (request('city_id')) {
            $this->filter_city = request('city_id');
        }
    }

    public function beforeSubmit()
    {
        if ($this->password) {
            $this->data['password'] = Hash::make($this->password);
        } else {
            $this->data['password'] = $this->obj->password;
        }
    }

    public function send_notification()
    {
        $user = $this->client;
        $this->validate(['library_id' => 'required|exists:notification_libraries,id']);
        $library = NotificationLibrary::findOrFail($this->library_id);
        Notification::create(['user_id' => $user->id, 'library_id' => $this->library_id, 'title' => $library->content]);
        session()->flash('success', 'تم الارسال بنجاح');
    }

    public function render()
    {
        // dd($this->filter_city);
        $clients = User::with(['city'])->where('type', 'client')->where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%" . $this->search . "%")
                    ->orWhere('phone', $this->search)
                    ->orWhere('email', $this->search);
            }
            if ($this->filter_active == 'active') {
                $q->where('active', 1);
            }
            if ($this->filter_active == 'inactive') {
                $q->where('active', 0);
            }
            if ($this->filter_city) {
                $q->where('city_id', $this->filter_city);
            }
            if ($this->filter_country) {
                $q->where('country_id', $this->filter_country);
            }
        })->latest('id')->paginate();
        // $levels = Level::latest()->get();
        // $countries = Country::latest()->get();
        // $states = State::where('country_id', $this->country_id)->latest()->get();
        // $regions = Region::where('state_id', $this->state_id)->latest()->get();
        $cities = City::where('country_id', $this->country_id)->latest()->get();
        return view('livewire.admin.clients.index', compact('clients', 'cities'))->extends('admin.layouts.admin')->section('content');
    }

    public function clientId($id)
    {
        $this->client = User::find($id);
    }

    public function sendToWhatsapp()
    {
        $this->validate([
            'message' => 'required',
            'image' => 'nullable|image',
        ]);

        try {
            DB::beginTransaction();

            if ($this->image) {
                $image = store_file($this->image, 'messages');

                $message = WhatsappMessage::create([
                    'message' => $this->message,
                    'image' => $image,
                    'client_id' => $this->client->id,
                    'user_id' => auth()->user()->id,
                ]);

                Whatsapp::sendWithImage($this->client->phone, $this->message, display_file($message->image));
            } else {
                WhatsappMessage::create([
                    'message' => $this->message,
                    'client_id' => $this->client->id,
                    'user_id' => auth()->user()->id,
                ]);

                Whatsapp::send($this->client->phone, $this->message);
            }

            DB::commit();

            $this->client->update(['contact' => true]);
            $this->reset();
            session()->flash('success', 'تم الارسال بنجاح');
            $this->dispatch('alert', ['type' => 'success', 'message' => 'تم الارسال بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            //dd($ex->getMessage());
            session()->flash('success', 'حدث خطأ أثناء الارسال');
            $this->dispatch('alert', ['type' => 'error', 'message' => 'حدث خطأ أثناء الارسال']);
        }
    }



    public function deleteContact($id)
    {
        $delete = ContactName::findOrFail($id);
        $delete->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }
}
