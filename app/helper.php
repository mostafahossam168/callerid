<?php

use Illuminate\Support\Facades\Storage;

function store_file($file,$path)
{
    $name = time().$file->getClientOriginalName();
    return $value = $file->storeAs($path, $name, 'uploads');
}
function delete_file($file)
{
    if($file!='' and !is_null($file) and Storage::disk('uploads')->exists($file)){
        unlink('uploads/'.$file);
    }
}
function display_file($name)
{
    return asset('uploads').'/'.$name;
}
function setting(){
    return \App\Models\Setting::query()->first();
}
function doctor(){
    return \App\Models\Doctor::query()->find(auth()->id());
}

function getProductQuantityInWarehouse(\App\Models\PharmacyMedicine $medicine,\App\Models\PharmacyWarehouse $warehouse){
   return $medicine->quantities()->wherePharmacyWarehouseId($warehouse->id)->charge()->sum('quantity')
        - $medicine->quantities()->where('from_warehouse_id',$warehouse->id)->expense()->sum('quantity')
        - \App\Models\PrescriptionItem::where('pharmacy_medicine_id',$medicine)->sum('quantity');
}
