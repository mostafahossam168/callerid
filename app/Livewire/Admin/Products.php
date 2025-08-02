<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Traits\livewireResource;
use Livewire\Component;

class Products extends Component
{
    use livewireResource;
    public $name ,$description,$image,$category_id;

    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable'
        ];
    }
    public function beforeSubmit()
    {
        if ($this->image) {
            if ($this->obj) {
                if ($this->obj->image !== $this->image) {
                    delete_file($this->obj->image);
                    $this->data['image'] = store_file($this->image, 'products');
                }
            } else {
                $this->data['image'] = store_file($this->image, 'products');
            }
        }
    }

    public function render()
    {
        $categories =Category::all();
        $products =Product::all();
        return view('livewire.admin.products',compact('products','categories'))->extends('admin.layouts.admin')->section('content');
    }
}
