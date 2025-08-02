<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiagnosesController extends Controller
{
    public function index()
    {
        return view('doctor.diagnoses.index');
    }
}
