<?php

namespace App\Http\Livewire\Reports;

use App\Models\Queue;
use Livewire\Component;
use Livewire\WithPagination;

class QueueReport extends Component
{
    public $from,$to;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function resetForm()
    {
        $this->reset('from','to','status');
    }
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
        $queues= Queue::withTrashed()->where(function($q){
            $this->between($q);
        })->latest()->paginate(10);
        
        return view('livewire.reports.queue-report',compact('queues'));
    }
}
