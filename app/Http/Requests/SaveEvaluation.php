<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveEvaluation extends FormRequest
{
  use MessagesTrait;
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
            /*
            'experience'=> 'required',
            'experience1'=> 'required',
            'experience2'=> 'required',
            'experience3'=> 'required',
            'experienceJ1'=> 'required',
            'experienceJ2'=> 'required',
            'essay'=> 'required',
            'essay1'=> 'required',
            'essay2'=> 'required',
            'essay3'=> 'required',
            'essay4'=> 'required',
            'video'=> 'required',
            'video1'=> 'required',
            'video2'=> 'required',
            'video3'=> 'required',
            'video4' => 'required'
            */
        ];
    }
}
