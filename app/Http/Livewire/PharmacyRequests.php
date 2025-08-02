<?php

namespace App\Http\Livewire;

use App\Models\PharmacyRequest;
use Livewire\Component;

class PharmacyRequests extends Component
{
    protected $listeners = ['updated' => '$refresh'];

    public $screen = 'index', $search;
    public $status = '';
    public $paid_drugs = [];
    public function render()
    {
        $requests = PharmacyRequest::when($this->search, function ($query) {
            $query->whereHas('patient', function ($q) {
                $q->where('id', $this->search)->orWhere('civil', $this->search)->orWhere('phone', $this->search);
            });
        })->with(['doctor', 'patient', 'clinic', 'room'])->latest()->paginate(10);

        return view('livewire.pharmacy-requests', compact('requests'));
    }

    public function delete(PharmacyRequest $request)
    {
        $request->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    protected function rules()
    {
        return [
            'status' => 'nullable',
            'paid_drugs' => 'array|min:1',
        ];
    }

    public function changestatus($id)
    {
        $data = $this->validate();
        $data['status'] = 'paid';
        
        $data['paid_drugs'] = collect($this->paid_drugs)->collapse()->all();
 
        $request = PharmacyRequest::find($id);
        $request->update($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully updated')]);
        return redirect()->route('front.pharmacy_requests');
    }

    public function unPay($id)
    {
        $data['status'] = 'pending';
        $data['paid_drugs'] = '';
        $request = PharmacyRequest::find($id);
        $request->update($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully updated')]);
        return redirect()->route('front.pharmacy_requests');
    }
}
