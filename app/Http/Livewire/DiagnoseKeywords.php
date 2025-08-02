<?php

namespace App\Http\Livewire;

use App\Models\DiagnoseKeyword;
use Livewire\Component;
use Livewire\WithPagination;

class DiagnoseKeywords extends Component
{
    use WithPagination;

    public $diagnose_keyword, $keywords;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'keywords' => 'required',
        ];
    }

    public function edit(DiagnoseKeyword $diagnose_keyword)
    {
        $this->keywords            = $diagnose_keyword->keywords;
        $this->diagnose_keyword        = $diagnose_keyword;
    }

    public function save()
    {
        $data = $this->validate();
        $data['user_id'] = auth()->id();
        if ($this->diagnose_keyword) {
            $this->diagnose_keyword->update($data);
        } else {
            DiagnoseKeyword::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }

    public function delete(DiagnoseKeyword $diagnose_keyword)
    {
        $diagnose_keyword->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $diagnose_keywords = DiagnoseKeyword::latest()->paginate(10);
        return view('livewire.diagnose-keywords', compact('diagnose_keywords'));
    }
}
