<?php

namespace App\Http\Controllers\Front;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
class AppointmentController extends Controller
{
    use JodaResource;
    protected $updateRules = [
        'patient_id' => 'sometimes',
        'doctor_id' => 'sometimes',
        'clinic_id' => 'sometimes',
        'appointment_date' => 'sometimes',
        'appointment_time' => 'sometimes',
        'appointment_status' => 'sometimes',
    ];
    protected $storeRules = [
        'patient_id' => 'required',
        'doctor_id' => 'required',
        'clinic_id' => 'required',
        'employee_id' => 'required',
        'appointment_number' => '',
    ];
    protected function beforeStore()
    {
        \request()->merge([
            'appointment_number' => Str::random(10),
        ]);
    }
    protected function afterStore($model = null)
    {
        if($model->appointment_date == null){
            // means transferred
            return redirect()->route('front.appointment.transferred');
        }
    }

    protected function beforeUpdate($model)
    {
        $unpaidInvoices = $model->patient->invoices()->where('status', 'unpaid')->get();
        if($unpaidInvoices->count() > 0){
            Session::flash('error', 'المريض لديه عمليات دفع غير مسددة');
        }
    }

    public function destroy(Appointment $appointment){
        $appointment->delete();
        return back()->with('success',__('Successfully deleted'));
    }

    public function bulkDelete(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
            } else {
                // Alert::error('لم يتم تحديد أي عنصر', 'لم يتم تحديد أي عنصر');
                Session::flash('error', 'لم يتم تحديد اى عنصر');
                return redirect()->back();
            }
            Appointment::destroy($delete_select_id);
            // Alert::success('تم مسح الكل بنجاح');
            Session::flash('success', 'تم مسح الكل بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            // Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            Session::flash('error', 'حدث خطاء');
            return redirect()->back();
        }
    }// end of bulkDelete



    public function bulkDelete_products(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
            } else {
                // Alert::error('لم يتم تحديد أي عنصر', 'لم يتم تحديد أي عنصر');
                Session::flash('error', 'لم يتم تحديد اى عنصر');
                return redirect()->back();
            }
            Product::destroy($delete_select_id);
            // Alert::success('تم مسح الكل بنجاح');
            Session::flash('success', 'تم مسح الكل بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            // Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            Session::flash('error', 'حدث خطاء');
            return redirect()->back();
        }
    }// end of bulkDelete
}
