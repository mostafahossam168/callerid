<?php

namespace App\Http\Livewire\Invoices;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;

class Invoices extends Component
{
    public $from, $to, $dr, $status, $department_id, $animal_id, $patient_id,
        $receptions, $employee_id, $search,
        $search_name, $retrieve_type, $retrieve_amount, $payment_method, $invoice_type = true;

    public $pharmacy_invoices;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }

    public function sendInvoiceWhatsapp(Invoice $invoice)
    {
        $this->dispatchBrowserEvent('copyInvoiceLink');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم نسخ الرسالة بنجاح']);
        return redirect()->away("");
    }

    public function delete(Invoice $invoice)
    {
        $invoice->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

    public function mount()
    {
        $this->receptions = User::receptions()->get();
        if (request()->status) {
            $this->status = request()->status;
        }
        if (request()->patient_id) {

            $this->patient_id = request()->patient_id;
        }
        if (request()->department_id) {
            $this->department_id = request()->department_id;
        }
        if (request()->employee_id) {
            $this->employee_id = request()->employee_id;
        }
    }

    public function render()
    {

        $doctors = Doctor::all();
        $departments = Department::all();

        $invoices = Invoice::with(['dr', 'employee', 'patient'])->where(function ($q) {
            $this->between($q);
            if ($this->dr) {
                $q->where('dr_id', $this->dr)->orWhere('employee_id', $this->dr);
            }
            if ($this->status) {
                $q->where('status', $this->status);
            }
            if ($this->search) {
                $q->where('id', $this->search);
            }
            if ($this->search_name) {
                $q->whereHas(
                    'patient',
                    function ($q) {
                        $q->where('first_name', 'like', '%' . $this->search_name . '%')
                            ->orWhere('phone', 'like', '%' . $this->search_name . '%');
                    }
                );
            }
            if ($this->pharmacy_invoices) {
                $q->whereNotNull('pharmacy_prescription_id');
            }
            if ($this->department_id) {
                $q->where('department_id', $this->department_id);
            }
            if ($this->patient_id) {
                $q->where('patient_id', $this->patient_id);
            }
            if ($this->employee_id) {
                $q->where('employee_id', $this->employee_id);
            }
        })->latest()->paginate(10);



        return view('livewire.invoices.invoices', compact('invoices', 'doctors', 'departments'));
    }

    public function retrieved(Invoice $invoice)
    {
        $data = $this->validate(['retrieve_type' => 'required', 'retrieve_amount' => 'required_if:retrieve_type,part', 'payment_method' => 'required_if:retrieve_type,part']);
        $payment_method = $this->payment_method;
        if ($this->retrieve_type == 'all') {
            $invoice->bonds()->create([
                'amount' => $invoice->total - $invoice->rest,
                'user_id' => auth()->id(),
                'rest' => $invoice->total,
                'payment_method' => $this->payment_method,
                'status' => 'debtor',
            ]);
            $invoice->update(['rest' => $invoice->total, 'status' => 'retrieved', 'cash' => 0, 'card' => 0, 'bank' => 0]);
        } else {
            $invoice->bonds()->create([
                'amount' => $this->retrieve_amount,
                'user_id' => auth()->id(),
                'rest' => $invoice->rest + $this->retrieve_amount,
                'payment_method' => $this->payment_method,
                'status' => 'debtor',
            ]);
            $invoice->update(['rest' => $invoice->rest + $this->retrieve_amount, 'status' => 'Partially retrieved', $payment_method => $invoice->$payment_method - $this->retrieve_amount]);
        }
        $this->reset(['retrieve_type', 'retrieve_amount', 'payment_method']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إعادة المبلغ بنجاح ']);
    }
}
