<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Warehouse;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\UserDepartment;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('read_employees');

        $users = User::NotAdmin()->with('department')->withTrashed()->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create_employees');
        $departments = Department::all();
        $roles = Role::get();
        $warehouses = Warehouse::get();

        return view('admin.users.create', compact('departments', 'roles', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create_employees');

        $request->validate([
            'name' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'unique:users,email', 'email'],
            'type' => ['required'],
            'group' => ['required'],
            'salary' => ['nullable', 'numeric'],
            //            'department_id' => $request->type == 'dr' ? 'required' : 'nullable',
            'show_department_products' => ['nullable'],
            'is_dentist' => ['nullable'],
            'is_dermatologist' => ['nullable'],
            'warehouse_id' => ['nullable']
        ]);

        $data = $request->except(['department_id']);
        // validate if rate_type != without_rate
        if ($request->rate_type != "without_rate") {
            if (!$request->rate) {
                return redirect()->back()->with('error', "rate is required");
            } else {
                $data['rate'] = $request->rate;
            }
        } else {
            $data['rate'] =  0;
        }
        $data['password'] = Hash::make($request->password);
        $data['rate_type'] = $request->rate_type;

        $user = User::create($data);
        $user->syncRoles($request->group);
        foreach ($request->department_id ?? [] as $department) {

            $userDepartment = new UserDepartment();
            $userDepartment->user_id = $user->id;
            $userDepartment->department_id = $department;
            $userDepartment->save();
        }
        return redirect()->route('admin.users.index')->with('success', __('Successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update_employees');

        $departments = Department::all();
        $roles = Role::get();
        $warehouses = Warehouse::get();

        return view('admin.users.edit', compact('departments', 'roles', 'user', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update_employees');

        $request->validate([
            'name' => ['required'],
            'password' => ['sometimes'],
            'email' => ['required', 'unique:users,email,' . $user->id, 'email'],
            'type' => ['required'],
            'group' => ['required'],
            'salary' => ['required', 'numeric'],
            //            'department_id' => $request->type == 'dr' ? 'required' : 'nullable',
            'show_department_products' => ['nullable'],
            'is_dentist' => ['nullable'],
            'is_dermatologist' => ['nullable'],
            'warehouse_id' => ['nullable']
        ]);
        $data = $request->except(['department_id']);
        if ($request->rate_type != "without_rate") {
            if (!$request->rate) {
                return redirect()->back()->with('error', "rate is required");
            }
        }
        $data['password'] = $request->password ? Hash::make($request->password) : $user->password;
        // handling rating types
        $data['rate_type'] = $request->rate_type;
        $data['rate'] = $request->rate ? $request->rate : 0;
        $data['is_dentist'] = $request->is_dentist ? 1 : 0;
        $data['is_dermatologist'] = $request->is_dermatologist ? 1 : 0;
        $user->update($data);
        $user->syncRoles($request->group);
        UserDepartment::where('user_id', $user->id)->delete();
        foreach ($request->department_id ?? [] as $department) {

            $userDepartment = new UserDepartment();
            $userDepartment->user_id = $user->id;
            $userDepartment->department_id = $department;
            $userDepartment->save();
        }
        return redirect()->route('admin.users.index')->with('success', __('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);

        if ($user->deleted_at) {
            $user->restore();
            return back()->with('success', __('Successfully restored'));
        } else {
            $user->delete();
            return back()->with('success', __('Successfully deleted'));
        }
    }
}
