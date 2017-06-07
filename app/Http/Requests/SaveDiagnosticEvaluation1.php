<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveDiagnosticEvaluation1 extends FormRequest
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

            'answer_q1_1'=> 'required',
            'answer_q1_2'=> 'required',
            'answer_q1_3'=> 'required',
            'answer_q1_j'=> 'required',
            'answer_q2_1'=> 'required',
            'answer_q2_2'=> 'required',
            'answer_q2_j'=> 'required',
            'answer_q3_1'=> 'required',
            'answer_q3_2'=> 'required',
            'answer_q3_3'=> 'required',
            'answer_q3_4'=> 'required',
            'answer_q3_j'=> 'required',

        ];
    }
}
