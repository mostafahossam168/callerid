<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected function index()
    {
        $departments = Department::get();
        $user = Auth::user();
        return view('front.profiles.edit', compact('user', 'departments'));
    }

    protected function update(Request $request, $id)
    {

        // dd($id);
        $request->validate([

            'name' => 'required',
            'email' => 'required',
            'department_id' => 'required',
            'salary' => 'required',
            'rate' => 'required',
        ]);

        $photo_in_db = NULL;
        if ($request->has('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);

            $path = public_path() . '/uploads/products';
            $photo = request('photo');
            $photo_name = time() . request('photo')->getClientOriginalName();
            $photo->move($path, $photo_name);
            $photo_in_db = '/uploads/products/' . $photo_name;
        }
        $user = User::where('id', $id)->update([

            'name'  => $request->name,
            'email'  => $request->email,
            'department_id'  => $request->department_id,
            'salary'  => $request->salary,
            'rate'  => $request->rate,
            'photo'  => $photo_in_db,
        ]);

        if ($user) {
            return redirect()->back()->withSuccess('تم تعديل دليل المستخدم بنجاح');
        } else {
            return redirect()->back()->withSuccess('يوجد خطا فى البيانات المدخله!');
        }
    }
}
