<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Taqnyat\SMS;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function setting()
    {
        $balance = SMS::balance();
        $status = SMS::status();
        // dd($balance, $status);
        return view('admin.message.index', compact('balance', 'status'));
    }

    public function settingStore(Request $request)
    {
        $data = $request->validate([
            'taqnyat_key' => 'required',
            'taqnyat_sender' => 'required',
            'taqnyat_status' => 'boolean',
            'taqnyat_modules_status' => 'nullable'
        ]);
        $data['taqnyat_modules_status'] = json_encode($data['taqnyat_modules_status']);
        // dd($data);
        setting()->update($data);
        return redirect()->back()->with('success', __('Saved successfully'));
    }
}
