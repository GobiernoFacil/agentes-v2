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
              'name'=> 'required|max:256|unique:activities',
              'duration'=> 'required|numeric',
              'description'=> 'required',
              'type'=>'required',
              'start'=>'required',
              'time'=>'required',
              'link'=>'required',
              'measure'=> 'required',
              'hasforum'=>'required',
              'order'=> 'required|numeric|integer',
          ];
        }elseif($this->type==='video'){
          return [
              //
              'name'=> 'required|max:256|unique:activities',
              'duration'=> 'required|numeric',
              'description'=> 'required',
              'type'=>'required',
              'link_video'=>'required',
              'measure'=> 'required',
              'hasforum'=>'required',
              'order'=> 'required|numeric|integer',
          ];

        }elseif($this->type==='evaluation'){
          return [
          'name'=> 'required|max:256|unique:activities',
          'duration'=> 'required|numeric',
          'measure'=> 'required',
          'description'=> 'required',
          'type'=>'required',
          'hasforum'=>'required',
          'end'=>'required',
          'files'=>'required',
          'order'=> 'required|numeric|integer',
        ];
        }else{
          return [
            //
            'name'=> 'required|max:256|unique:activities',
            'measure'=> 'required',
            'duration'=> 'required|numeric',
            'description'=> 'required',
            'type'=>'required',
            'hasforum'=>'required',
            'order'=> 'required|numeric|integer',
        ];
      }
    }
}
