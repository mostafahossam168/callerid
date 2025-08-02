<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Traits\livewireResource;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Categories extends Component
{
    use livewireResource, WithFileUploads;
    public $name, $status = 'possible', $notes, $search,$parent_id ,$category,$cover,$img;
    public Collection $allClients;
    // public function export()
    // {
    //     return Excel::download(new ClientsExport($this->allClients), 'clients' . time() . '.xlsx');
    // }
    public function rules()
    {
        return ['name' => 'required', 'status' => 'nullable','cover' => 'nullable'];
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
    // public function mount()
    // {
    //     $this->cities = City::query()->get() ?? [];
    //     $this->programs = Program::all();
    //     $this->allClients = Client::all();
    //     $this->users = User::all();
    //     $this->possibleCients = Client::where('status', 'possible')->count();
    //     $this->interestedCients = Client::where('status', 'interested')->count();
    //     $this->notInterestedCients = Client::where('status', 'not_interested')->count();
    //     $this->trueCients = Client::where('status', 'true')->count();
    //     if (request('city_id')) {
    //         $this->filter_city = request('city_id');
    //     }
    //     if (request('program_id')) {
    //         $this->filter_program = request('program_id');
    //     }
    // }
    // public function beforeSubmit()
    // {
    //     $this->data['user_id'] = auth()->id();
    // }
    public function render()
    {
        // dd($this->filter_city);
        $categories = Category::where('parent_id','=',null)->where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%" . $this->search . "%");
            }

        })->latest('id')->paginate();
        return view('livewire.admin.categories.index', compact('categories'))->extends('admin.layouts.admin')->section('content');
    }

    public function categorytId($id)
    {
        $this->category = Category::find($id);
    }


}
