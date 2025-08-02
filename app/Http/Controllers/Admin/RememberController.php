<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsRemember;
use Illuminate\Http\Request;

class RememberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sms=SmsRemember::latest()->paginate(10);
        return view('admin.sms-remember.index',compact('sms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sms-remember.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate(['title'=>'required', 'message'=>'required']);
        SmsRemember::create($data);
        return redirect()->route('admin.sms.index')->with('success',__('Successfully added'));
    }

    /**
     * Display the specified resource.
     
     */
    public function show(SmsRemember $smsRemember)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsRemember $sms)
    {
        return view('admin.sms-remember.edit',compact('sms'));
        
    }

    /**
     * Update the specified resource in storage.
     *
    
     */
    public function update(Request $request, SmsRemember $sms)
    {
        $data=$request->validate(['title'=>'required', 'message'=>'required']);
        $sms->update($data);
        return redirect()->route('admin.sms.index')->with('success',__('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsRemember $sms)
    {
        $sms->delete();
        return back()->with('success',__('Successfully deleted'));
    }
}
