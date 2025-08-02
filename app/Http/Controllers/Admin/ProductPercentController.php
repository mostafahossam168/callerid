<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPercent;
use App\Models\User;
use Illuminate\Http\Request;

class ProductPercentController extends Controller
{
    public function index()
    {
        $product_percents = ProductPercent::when(request('user_id'), function ($q) {
            $q->where('doctor_id', request('user_id'));
        })->latest()->paginate(10);
        return view('admin.product_percents.index', compact('product_percents'));
    }

    public function create()
    {
        $doctors = User::doctors()->get();
        $products = Product::get();
        return view('admin.product_percents.create', compact('doctors', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'doctor_id' => 'required',
            'product_ids' => 'required|array',
            'percent' => 'required|numeric',
        ]);
        unset($data['product_ids']);
        foreach ($request->product_ids as $product_id){
            $data['product_id'] = $product_id;
            ProductPercent::create($data);
        }
        return redirect()->route('admin.product_percents.index')->with('success', __('Successfully added'));
    }

    public function edit(ProductPercent $product_percent)
    {
        $doctors = User::doctors()->get();
        $products = Product::get();
        return view('admin.product_percents.edit', compact('product_percent', 'doctors', 'products'));
    }

    public function update(Request $request, ProductPercent $product_percent)
    {
        $data = $request->validate([
            'doctor_id' => 'required',
            'product_id' => 'required',
            'percent' => 'required|numeric',
        ]);
        $product_percent->update($data);
        return redirect()->route('admin.product_percents.index')->with('success', __('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPercent $product_percent)
    {
        $product_percent->delete();
        return back()->with('success', __('Successfully deleted'));
    }
}
