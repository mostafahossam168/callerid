<?php

namespace App\Http\Livewire\Reports;

use App\Models\Department;
use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ClidocReport extends Component
{
    public $from, $to, $paid, $department_id, $dr_id,$status;
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
    public function render()
    {
        $invoices = [];
        if ($this->dr_id or $this->department_id) {
            $invoices = Invoice::with(['patient', 'dr'])->where(function ($q) {
                if ($this->dr_id) {
                    $q->where('dr_id', $this->dr_id);
                }
                $this->between($q);
                if ($this->department_id) {
                    $q->where('department_id', $this->department_id);
                }
                if ($this->paid == 'cash') {
                    $q->where('cash', '>', 0);
                }
                if ($this->paid == 'card') {
                    $q->where('card', '>', 0);
                }
                if ($this->status) {
                    $q->where('status', $this->status);
                }
            })->latest()->paginate(10);
        }
        $departments = Department::all();
        $doctors = User::doctors()->whereHas('departments',function ($q){
            $q->where('departments.id',$this->department_id);
        })->withTrashed()->get();
        return view('livewire.reports.clidoc-report', compact('invoices', 'doctors', 'departments'));
    }
}
