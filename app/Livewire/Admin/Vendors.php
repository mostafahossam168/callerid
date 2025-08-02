<?php

namespace App\Livewire\Admin;

use App\Models\City;
use App\Models\User;
use App\Traits\livewireResource;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Vendors extends Component
{
    use livewireResource;
    public $user_id,$name,$email,$password,$type='vendor',$role_id,$city_id,$image,$phone;
    protected function rules()
    {
        return [
            'name' => ['string', 'required'],
            'password' => ['required_without:obj'],
            'email' => ['nullable','email', 'unique:users,email,' . $this->obj?->id],
            'type'=>['nullable'],
            'city_id' =>'required',
            'role_id'=>['required'],
            'image' =>'nullable',
            'phone' =>'required|unique:users,phone,' . $this->obj?->id,
        ];
    }

    public function toggle($id)
    {
        $user =User::findOrFail($id);
        $user->active =!$user->active;
        $user->save();
    }
    public function setModelName()
    {
        $this->model='App\Models\User';
}
    public function beforeSubmit()
    {
        unset($this->data['role_id']);
        if($this->password){
            $this->data['password']=Hash::make($this->password);
        }else{
            $this->data['password']=$this->obj->password;
        }
        if (!$this->image) {
            return;
        }
        if ($this->obj) {
            if ($this->obj->image !== $this->image) {
                delete_file($this->obj->image);
                $this->data['image'] = store_file($this->image, 'articles');
            }
        } else {
            $this->data['image'] = store_file($this->image, 'articles');
        }

    }
    public function afterSubmit()
    {
        $this->obj?->syncRoles($this->role_id);
    }
    public function whileEditing()
    {
        $this->role_id=$this->obj->role->id;
    }

    public function render()
    {
        $roles=Role::all();
        $users=User::where('type','vendor')->paginate(10);
        $cities =City::all();
        return view('livewire.admin.Vendors.index',compact('users', 'roles','cities'))->extends('admin.layouts.admin')->section('content');
    }
}
