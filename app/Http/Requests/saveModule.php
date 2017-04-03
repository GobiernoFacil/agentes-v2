<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class saveModule extends FormRequest
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
            'title'=> 'required|unique:modules',
            'number_sessions'=> 'required',
            'number_hours'=> 'required',
            'modality'=> 'required',
            'teaching_situation'=> 'required',
            'objective'=> 'required',
            'product_developed'=> 'required',
            'start'=> 'required',
            'end'=> 'required',
            'public'=> 'required',
        ];
    }
}
