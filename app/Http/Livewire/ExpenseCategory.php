<?php

namespace App\Http\Livewire;

use App\Models\ExpenseCategory as ModelsExpenseCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseCategory extends Component
{
    public $name, $parent, $category;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'name' => 'required',
            'parent' => 'nullable',
        ];
    }
    public function edit(ModelsExpenseCategory $category)
    {
        $this->name = $category->name;
        $this->parent = $category->parent;
        $this->category = $category;
    }
    public function save()
    {
        $data = $this->validate();
        if ($this->category) {
            $this->category->update($data);
        } else {
            ModelsExpenseCategory::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(ModelsExpenseCategory $category)
    {
        $category->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $main_cats = ModelsExpenseCategory::whereNull('parent')->get();
        $categories = ModelsExpenseCategory::with('main')->latest()->paginate(10);
        return view('livewire.expense-category', compact('main_cats', 'categories'));
    }
}
