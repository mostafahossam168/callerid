<?php

namespace App\Http\Livewire\Animals;

use App\Models\InvoiceItem;
use Livewire\Component;
use App\Models\LabRequest;
use App\Models\Appointment;
use App\Models\PatientFile;
use App\Models\ScanRequest;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Request;

class ViewPatient extends Component
{
    public $patient,$animals, $screen = 'data', $invoice_status, $scan_file, $lab_file, $file_name, $scan_dr_content, $lab_dr_content, $file;
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

    public function save_file()
    {
        $data = $this->validate();
        $data['animal_id'] = $this->patient->id;
        $data['patient_id'] = 0;
        $data['file_path'] = store_file($this->file, 'animals_file');
        $data['file_type'] = $this->file->getExtension();
        $data['file_size'] = $this->file->getSize();
        $data['employee_id'] = auth()->id();
        unset($data['file']);
        PatientFile::create($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
        $this->reset(['file_name', 'file']);
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
        $scanRequests = $this->patient->scanRequests()->latest()->paginate(5);
        $analyses = $this->patient->analyses()->latest()->paginate(5);
        $logs = $this->patient->offerLogs()->latest('id')->paginate();
        $vaccines =InvoiceItem::where('animal_id',$this->patient->id)
            ->whereNotNull('vaccine_id')
            ->whereHas('invoice')
            ->get();
        return view('livewire.animals.view-patient', compact('invoices', 'appoints', 'diagnoses', 'files', 'scanRequests', 'analyses', 'logs','vaccines'));
    }
    public function storeFileScan(ScanRequest $scan)
    {
        $this->validate([
            'scan_file' => 'required',
            // 1MB Max
            'scan_dr_content' => 'nullable', // 1MB Max
        ]);

        $scan->file = store_file($this->scan_file, 'scans');
        $scan->scan_content = $this->scan_dr_content;
        $scan->status = 'done';
        $scan->update();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
        $this->reset(['scan_dr_content', 'scan_file']);

    }
    public function storeFileLab(LabRequest $lap)
    {
        $data = $this->validate([
            'lab_file' => 'required',
            // 1MB Max
            'lab_dr_content' => 'nullable', // 1MB Max
        ]);
        $lap->file = store_file($this->lab_file, 'labs');
        $lap->lab_content = $this->lab_dr_content;
        $lap->status = 'done';
        $lap->update();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
        $this->reset(['lab_dr_content', 'lab_file']);

    }
}
