<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveModule extends FormRequest
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
       $date = strtotime($this->start);
       $date = strtotime("+8 day", $date);
        return [
            //
            'title'=> 'required|max:256|unique:modules',
            'modality'=> 'required',
            'start'=> 'required',
            'end'=> 'required|before:'.date('Y-m-d',$date),
            'public'=> 'required',
        ];
    }
}