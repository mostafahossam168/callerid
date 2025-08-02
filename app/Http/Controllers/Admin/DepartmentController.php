<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments=Department::latest()->paginate(10);
        return  view('admin.departments.index',compact('departments'));
    }
    public function create()
    {
        $main_departments=Department::whereNull('parent')->get();
        return  view('admin.departments.create',compact('main_departments'));
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>['required'],
            'parent'=>['nullable','exists:departments,id'],
            'is_lab'=>['nullable'],
            'is_scan'=>['nullable'],
            'is_hotel_service' =>['nullable']
        ],[],[
            'name'=>__('name'),
            'parent'=>__('parent'),
        ]);
        $data['is_lab']=$request->is_lab?true:false;
        $data['is_scan']=$request->is_scan?true:false;
        $data['is_hotel_service']=$request->is_hotel_service?true:false;
        Department::create($data);
        return redirect()->route('admin.departments.index')->with('success',__('Successfully added'));
    }


    public function edit(Department $department)
    {
        $main_departments=Department::whereNull('parent')->get();
        return  view('admin.departments.edit',compact('main_departments','department'));
    }

    public function update(Request $request, Department $department)
    {
        $data=$request->validate([
            'name'=>['required'],
            'parent'=>['nullable','exists:departments,id'],
            'is_lab'=>['nullable'],
            'is_scan'=>['nullable'],
            'is_hotel_service'=>['nullable'],
        ],[],[
            'name'=>__('name'),
            'parent'=>__('parent'),
        ]);
        $data['is_lab']=$request->is_lab?true:false;
        $data['is_scan']=$request->is_scan?true:false;
        $data['is_hotel_service']=$request->is_hotel_service?true:false;
        $department->update($data);
        return redirect()->route('admin.departments.index')->with('success',__('Successfully updated'));
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('success',__('Successfully deleted'));

    }
}
