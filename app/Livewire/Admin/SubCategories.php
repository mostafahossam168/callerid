<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubCategories extends Component
{
    use livewireResource, WithFileUploads;
    public $name, $status = 'possible', $notes, $search ,$category,$cover,$img , $parent_id ;

    public $model = 'App\Models\Category';
    public function rules()
    {
        return [
            'name' => 'required',
            'status' => 'nullable',
            'cover' => 'nullable',
            'parent_id'  => 'required'
        ];
    }
    public function changeContact(Category $category)
    {
        $category->update(['contact' => !$category->contact]);
        session()->flash('success', 'تم التعديل بنجاح');
    }
    public function beforeSubmit()
    {
        if($this->img){
            $this->data['cover']=store_file($this->img,'departments');
        }
    }

    public function render()
    {
        $categories = Category::whereNotNull('parent_id')->where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%" . $this->search . "%");
            }

        })->latest('id')->paginate();
        return view('livewire.admin.sub_categories.index', compact('categories'))->extends('admin.layouts.admin')->section('content');
    }

    public function categorytId($id)
    {
        $this->category = Category::find($id);
    }


}
