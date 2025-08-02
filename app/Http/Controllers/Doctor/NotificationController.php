<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->user()->id)->latest()->paginate(10);
        if (!auth()->user()->can('الاشعارات')) {
            abort(403);
        }
        return view('doctor.notifications.index', compact('notifications'));
    }

    public function bulkDelete(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
            } else {
                Session::flash('error', 'لم يتم تحديد اى عنصر');
                return redirect()->back();
            }
            Notification::destroy($delete_select_id);
            Session::flash('success', 'تم مسح الكل بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', 'حدث خطاء');
            return redirect()->back();
        }
    }
}
