<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Select2Pagination extends Controller
{
    public function patients()
    {
        if (\request()->ajax()) {
            $search = trim(\request('search'));
            $type = request('type');
            $posts = DB::table('patients')->select('id', 'first_name as text')
                ->where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%')
                ->simplePaginate(10);

            $morePages = true;
            $pagination_obj = json_encode($posts);
            if (empty($posts->nextPageUrl())) {
                $morePages = false;
            }
            $results = array(
                "results" => $posts->items(),
                "pagination" => array(
                    "more" => $morePages
                )
            );
            return \Response::json($results);
        }
    }

    public function products()
    {
        if (\request()->ajax()) {
            $search = trim(\request('search'));
            $posts = DB::table('products')->select('id', 'name as text')
                ->where('name', 'LIKE', '%' . $search . '%')
                //                ->where('department_id', \request('department_id'))
                ->simplePaginate(10);

            $morePages = true;
            $pagination_obj = json_encode($posts);
            if (empty($posts->nextPageUrl())) {
                $morePages = false;
            }
            $results = array(
                "results" => $posts->items(),
                "pagination" => array(
                    "more" => $morePages
                )
            );
            return \Response::json($results);
        }
    }
    public function animals()
    {
        if (\request()->ajax()) {
            $search = trim(\request('search'));
            $patient_id = request('patient_id');
            $posts = DB::table('animals')->select('id', 'name as text')
                ->where('name', 'LIKE', '%' . $search . '%')
                ->where('patient_id', '=', $patient_id)
                ->simplePaginate(10);

            $morePages = true;
            $pagination_obj = json_encode($posts);
            if (empty($posts->nextPageUrl())) {
                $morePages = false;
            }
            $results = array(
                "results" => $posts->items(),
                "pagination" => array(
                    "more" => $morePages
                )
            );
            return \Response::json($results);
        }
    }

    public function items()
    {
        if (\request()->ajax()) {
            $search = trim(\request('search'));
            $posts = DB::table('items')
                ->select('id', DB::raw("REPLACE(name_en, '''', '') as text"))
                ->where('name_en', 'LIKE', '%' . $search . '%')
                // ->where('category_id', \request('category_id'))
                ->simplePaginate(10);


            $morePages = true;
            $pagination_obj = json_encode($posts);
            if (empty($posts->nextPageUrl())) {
                $morePages = false;
            }
            $results = array(
                "results" => $posts->items(),
                "pagination" => array(
                    "more" => $morePages
                )
            );
            return \Response::json($results);
        }
    }
}