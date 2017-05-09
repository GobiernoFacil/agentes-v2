<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveActivity extends FormRequest
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

        if($this->type==='webinar'){
          return [
              //
              'name'=> 'required|unique:activities',
              'order'=> 'required|numeric',
              'duration'=> 'required|numeric',
              'facilitator_role'=> 'required',
              'description'=> 'required',
              'competitor_role'=> 'required',
              'type'=>'required',
              'start'=>'required',
              'time'=>'required',
              'link'=>'required',
          ];
        }elseif($this->type==='video'){
          return [
              //
              'name'=> 'required|unique:activities',
              'order'=> 'required|numeric',
              'duration'=> 'required|numeric',
              'facilitator_role'=> 'required',
              'description'=> 'required',
              'competitor_role'=> 'required',
              'type'=>'required',
              'link_video'=>'required',
          ];

        }else{

        return [
            //
            'name'=> 'required|unique:activities',
            'order'=> 'required|numeric',
            'duration'=> 'required|numeric',
            'facilitator_role'=> 'required',
            'description'=> 'required',
            'competitor_role'=> 'required',
            'type'=>'required',
        ];
      }
    }
}
