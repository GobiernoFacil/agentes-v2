<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveSession extends FormRequest
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
            'name'=> 'required|unique:module_sessions',
            'order'=> 'required|numeric',
            'hours'=> 'required|numeric',
            'modality'=> 'required',
            'objective'=> 'required',
            'start'=> 'required',
            'end'=> 'required',
        ];
    }
}