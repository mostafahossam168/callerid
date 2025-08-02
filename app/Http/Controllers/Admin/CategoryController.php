<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories=Category::latest()->paginate(10);
        return  view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_categories=Category::whereNull('parent')->get();
        return  view('admin.categories.create',compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>['required'],
            'parent'=>['nullable','exists:categories,id'],
        ],[],[
            'name'=>__('name'),
            'parent'=>__('parent'),
        ]);
        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success',__('Successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $Category)
    {
        $main_categories=Category::whereNull('parent')->get();
        return  view('admin.categories.edit',compact('main_categories','Category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $Category)
    {
        $data=$request->validate([
            'name'=>['required'],
            'parent'=>['nullable','exists:categories,id'],
        ],[],[
            'name'=>__('name'),
            'parent'=>__('parent'),
        ]);
        $Category->update($data);
        return redirect()->route('admin.categories.index')->with('success',__('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success',__('Successfully deleted'));
        
    }
}
