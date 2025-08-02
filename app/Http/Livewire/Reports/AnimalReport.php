<?php

namespace App\Http\Livewire\Reports;

use App\Models\Animal;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AnimalReport extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $categories = Category::withCount('animals')->paginate(10);

        return view('livewire.reports.animal-report', compact('categories'));
    }
}
