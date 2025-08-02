<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required",
            "description" => "required",
            "video" => [
                'required',
                'url',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/', $value)) {
                        $fail(trans("يجب ان يكون يويتيوب", ["name" => trans("general.url")]));
                    }
                },
            ],
        ];
    }
}
