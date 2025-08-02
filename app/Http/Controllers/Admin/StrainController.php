<?php

namespace App\Http\Controllers\Admin;

use App\Models\Strain;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StrainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strains = Strain::latest()->paginate(10);
        return  view('admin.strains.index', compact('strains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_categories = Category::get();
        return  view('admin.strains.create', compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);
        Strain::create($data);
        // return redirect()->route('admin.strains.index')->with('success',__('Successfully added'));
        return back()->with('success', __('Successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Strain $strain)
    {
        $main_categories = Category::get();
        return  view('admin.strains.edit', compact('main_categories', 'strain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Strain $strain)
    {
        $data = $request->validate([
            'name' => ['required'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);
        $strain->update($data);
        return redirect()->route('admin.strains.index')->with('success', __('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Strain $strain)
    {
        $strain->delete();
        return back()->with('success', __('Successfully deleted'));
    }
}
