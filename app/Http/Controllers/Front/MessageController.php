<?php

namespace App\Http\Controllers\Front;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Services\Taqnyat\SMS;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->get();
        return view('front.message.index', compact('patients'));
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required_if:patient_id,custom',
            'patient_id' => 'required',
            'message' => 'required'
        ]);

        if ($data['patient_id'] == 'custom') {
            $phone = $data['phone'];
            if (setting()->taqnyat_status) {
                // $phone = substr($this->patient->phone, 1);
                $response = SMS::send(['966' . $phone], $data['message']);
                if (!in_array($response?->statusCode, [200, 201])) {
                    return redirect()->back()->with('error', 'خطأ في ارسال الرسالة ' . $response?->message);
                } else {
                    return redirect()->back()->with('error', 'تم إرسال الرسالة بنجاح');
                }
            } else {
                return redirect()->back()->with('error', 'برجاء تفعيل منصة الرسائل قبل الارسال');
            }
        } else {
            $patient = Patient::find($data['patient_id']);
            if ($patient) {
                if (setting()->taqnyat_status) {
                    $phone = substr($this->patient->phone, 1);
                    $response = SMS::send(['966' . $phone], $data['message']);
                    if (!in_array($response?->statusCode, [200, 201])) {
                        return redirect()->back()->with('error', 'خطأ في ارسال الرسالة ' . $response?->message);
                    } else {
                        return redirect()->back()->with('error', 'تم إرسال الرسالة بنجاح');
                    }
                } else {
                    return redirect()->back()->with('error', 'برجاء تفعيل منصة الرسائل قبل الارسال');
                }
            }
        }
    }


}
