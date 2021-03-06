<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class AddSingleFileEvaluation extends FormRequest
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
                'file_e' => 'file|mimes:doc,docx,pdf|max:100000',
                'score' => 'required|numeric|between:0,10',
                'fellow_id'=>'required'
            ];
    }
}
