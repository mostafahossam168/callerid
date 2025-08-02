<?php

namespace App\Http\Controllers\Admin;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Submit;
use Illuminate\Http\Request;

class SubmitController extends Controller
{
    use JodaResource;
    public function show(Submit $submit){
        $questions=Question::all();
        return view('admin.submit.show',compact('submit','questions'));
    }
}
