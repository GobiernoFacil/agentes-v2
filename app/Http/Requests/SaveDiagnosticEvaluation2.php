<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveDiagnosticEvaluation2 extends FormRequest
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
            'answer_q5_1'=> 'required',
            'answer_q5_2'=> 'required',
            'answer_q5_3'=> 'required',
            'answer_q5_j'=> 'required',
            'answer_q4_1'=> 'required',
            'answer_q4_2'=> 'required',
            'answer_q4_j'=> 'required',
        ];
    }
}
