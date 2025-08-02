<?php

namespace App\Livewire\Admin;

use App\Models\Page;
use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithPagination;

class Pages extends Component
{
    use WithPagination, livewireResource;
    public $name, $search, $content;
    public function rules()
    {
        return [
            'name' => ['required'],
            'content' => ['nullable']
        ];
    }

    public function render()
    {
        $pages = Page::latest()->where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%$this->search%");
            }
        })->paginate(10);
        // $this->dispatch('classicEditor');
        return view('livewire.admin.pages', compact('pages'))->extends('admin.layouts.admin')->section('content');
    }

/*public function submit()
{
$data = $this->validate();
dd($data);
if ($this->page_id) {
$page = Page::find($this->page_id);
$page->update($data);
$action = 'تعديل';
} else {
$page = Page::create($data);
$action = 'إضافة';
}
$this->resetForm();
$this->dispatch('alert', ['type' => 'success', 'message' => 'تم ' . $action . '  السياسة  بنجاح']);
} */
}
