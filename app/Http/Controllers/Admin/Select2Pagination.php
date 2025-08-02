<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class Select2Pagination extends Controller
{
    public function patients()
    {
        if (\request()->ajax()) {

            $search = trim(\request('search'));
            $patients = DB::table('patients')
                ->where(DB::raw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))"), 'LIKE', '%' . $search . '%')
                ->select('id', DB::raw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) as text"))
                ->simplePaginate(10);

            $morePages = true;
            $pagination_obj = json_encode($patients);
            if (empty($patients->nextPageUrl())) {
                $morePages = false;
            }
            $all_option =[
                ['id' => 'all', 'text' => 'كل المرضي'],
            ];

            $results = array(
                "results" => array_merge($all_option,$patients->items()),
                "pagination" => array(
                    "more" => $morePages
                )
            );

            return \Response::json($results);
        }
    }
}
