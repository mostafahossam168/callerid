<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PatientFile;
use Illuminate\Http\Request;

class ShowAnimalTestController extends Controller
{
    public function __invoke($id)
    {
        $file=PatientFile::find($id);
        return view('front.AnimalTests.show-test',compact('file'));
    }
}
