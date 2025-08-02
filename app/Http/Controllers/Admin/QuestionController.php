<?php

namespace App\Http\Controllers\Admin;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddImagesRequest;
use App\Http\Requests\AddVideoRequest;
use App\Models\Question;
use App\Models\QuestionImage;
use App\Models\Video;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    use JodaResource;
    protected $rules = [
        'title' => 'required',
        'answers' => 'required'
    ];
    public function query($query)
    {
        if (request('questionnaire_id')) {
            return $query->where('questionnaire_id', request('questionnaire_id'))->latest()->paginate(10);
        }
        return $query->latest()->paginate(10);
    }
    public function beforeStore()
    {
        if (request('answers')) {
            \request()->merge(['answers' => explode('-', request('answers'))]);
        }
    }
    public function beforeUpdate()
    {
        if (request('answers')) {
            \request()->merge(['answers' => explode('-', request('answers'))]);
        }
    }

    public function add_video()
    {
        return view("admin.question.video");
    }

    public function store_video(AddVideoRequest $request)
    {
        Video::create($request->all());
        return redirect('ar/admin/questions');
    }

    public function add_images()
    {
        return view("admin.question.image");
    }

    public function store_images(AddImagesRequest $request)
    {
        foreach ($request->images as $image) {
            QuestionImage::create([
                "image" => $this->store_multi_doc($request, $image, "uploads/question_images"),
                "description" => $request->description
            ]);
        }
        return redirect('ar/admin/questions');
    }

    public function get_all_questions()
    {
        $questions = Question::latest()->get();
        // return $questions[0]->answers ;
        return view('front.guide', compact('questions'));
    }
}
