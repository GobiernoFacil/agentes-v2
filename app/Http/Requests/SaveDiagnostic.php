<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveDiagnostic extends FormRequest
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
          'answer_1'=> 'required',
          'answer_2'=> 'required',
          'answer_3'=> 'required',
          'answer_4'=> 'required',
          'answer_5'=>'required'
      ];
    }
}
