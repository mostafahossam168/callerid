<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function settings(Request $request)
    {
        $validated = $request->except('_token');
        // dd($validated);
        $data = $request->all();
        if ($request->file('logo')) {
            delete_file(setting()->logo);
            $data['logo'] = store_file($request->file('logo'), 'settings');
        } else {
            $data['logo'] = setting()->logo;
        }

        if ($request->hasFile('icon')) {
            delete_file(setting()->icon);
            $data['icon'] = store_file($request->icon, 'settings');
        } else {
            $data['icon'] = setting()->icon;
        }
        $data['new_invoice_form'] = $request->new_invoice_form ? 1 : 0;
        $data['active_scan_and_lab'] = $request->active_scan_and_lab ? 1 : 0;
        $data['complaint'] = $request->complaint ? 1 : 0;
        $data['active_transfer_print'] = $request->active_transfer_print ? 1 : 0;
        $data['active_tax_info_in_patients'] = $request->active_tax_info_in_patients ? 1 : 0;
        $data['whatsapp_status'] = $request->whatsapp_status ? 1 : 0;
        $data['active_number_sim'] = $request->active_number_sim ? 1 : 0;
        $data['payment_gateways'] = $request->payment_gateways ? 1 : 0;
        $data['active_tamara'] = $request->active_tamara ? 1 : 0;
        $data['active_tabby'] = $request->active_tabby ? 1 : 0;
        $data['main_pharmacy_warehouse_id'] = $request->main_pharmacy_warehouse_id != '' ? $request->main_pharmacy_warehouse_id : null;
        $data['delete_transfer'] = $request->delete_transfer ? 1 : 0;


        setting()->update($data);
        return back()->with('success', __('Successfully updated'));
    }
}
