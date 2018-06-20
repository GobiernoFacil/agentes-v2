<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveGeneralSurvey extends FormRequest
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
      if($this->type === "facilitator"){
        return [
            //
            'description'=> 'required',
            'type'=> 'required',
            'title'=> 'required|max:256|unique:custom_questionnaires',
            'facilitator_id' => 'required'
        ];
      }else{
        return [
            //
            'description'=> 'required',
            'type'=> 'required',
            'title'=> 'required|max:256|unique:custom_questionnaires',
        ];
      }

    }
}
