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
              'order'=> 'required',
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
              'order'=> 'required',
          ];

        }elseif($this->type==='evaluation' || $this->type==='final'){
          return [
          'name'=> 'required|max:256|unique:activities',
          'duration'=> 'required|numeric',
          'measure'=> 'required',
          'description'=> 'required',
          'type'=>'required',
          'hasforum'=>'required',
          'end'=>'required',
          'files'=>'required',
          'order'=> 'required',
        ];
      }elseif($this->type==='diagnostic'){
          return [
          'name'=> 'required|max:256|unique:activities',
          'duration'=> 'required|numeric',
          'measure'=> 'required',
          'description'=> 'required',
          'type'=>'required',
          'hasforum'=>'required',
          'end'=>'required',
          'order'=> 'required',
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
            'order'=> 'required',
        ];
      }
    }
}
