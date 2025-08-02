<?php

namespace App\Livewire\Admin;

use App\Exports\ClientsExport;
use App\Models\Contact;
use App\Models\ContactName;
use App\Traits\livewireResource;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Contacts extends Component
{

    use livewireResource;
    public  $search;
    public function rules()
    {
        return [];
    }

    public function export()
    {
        $items = \App\Models\Contact::all();
        return Excel::download(new ClientsExport($items), 'clients' . time() . '.xlsx');
    }

    public function setModelName()
    {
        $this->model = 'App\Models\Contact';
    }
    public function render()
    {
        $contacts = \App\Models\Contact::where(function ($q) {

            if ($this->search) {
                $countryCodes = countryCode();
                $number = $this->search;

                foreach ($countryCodes as $code) {
                    if (strpos($number, $code) === 0) {
                        $number = substr($number, strlen($code));
                        break;
                    }
                }
                $q->where('phone_number', 'LIKE', '%' . $number . '%');
            }
        })->paginate(30);
        return view('livewire.admin.contacts', compact('contacts'))->extends('admin.layouts.admin')->section('content');
    }

    public function deleteContact($id)
    {
        $delete = ContactName::findOrFail($id);
        $delete->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }
}