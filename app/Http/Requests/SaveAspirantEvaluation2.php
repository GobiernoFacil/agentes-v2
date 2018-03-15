<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveAspirantEvaluation2 extends FormRequest
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
            //
            'videoGrade' => 'required|numeric|between:0,10',
            'experienceGrade' => 'required|numeric|between:0,10',
            'essayGrade' => 'required|numeric|between:0,10'
        ];
    }
}
