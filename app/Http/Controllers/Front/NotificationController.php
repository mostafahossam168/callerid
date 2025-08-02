<?php

namespace App\Http\Controllers\Front;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
class NotificationController extends Controller
{
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
            Notification::destroy($delete_select_id);
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
