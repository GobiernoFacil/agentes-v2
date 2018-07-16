<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use App\Models\Activity;
class UpdateActivity extends FormRequest
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

        $activity = Activity::find($this->route("id"));
        if($this->type==='webinar'){
          return [
              //
              'name'=> 'required|max:256'.($activity->name != $this->name ? '|unique:activities' : ''),
              'duration'=> 'required|numeric',
              'measure'=> 'required',
              'description'=> 'required',
              'type'=>'required',
              'order'=> 'required',
              'start'=>'required',
              'time'=>'required',
              'link'=>'required',
              'hasforum'=>'required'
          ];
        }elseif($this->type==='video'){
          return [
              //
              'name'=> 'required|max:256'.($activity->name != $this->name ? '|unique:activities' : ''),
              'duration'=> 'required|numeric',
              'measure'=> 'required',
              'description'=> 'required',
              'type'=>'required',
              'link_video'=>'required',
              'hasforum'=>'required',
              'order'=> 'required',
          ];
        }elseif($this->type==='evaluation' ){
          return [
              //
              'name'=> 'required|max:256'.($activity->name != $this->name ? '|unique:activities' : ''),
              'duration'=> 'required|numeric',
              'measure'=> 'required',
              'description'=> 'required',
              'type'=>'required',
              'hasforum'=>'required',
              'files'=>'required',
              'end'=>'required',
              'order'=> 'required',
          ];
        }elseif($this->type==='final' ){
          return [
              //
              'name'=> 'required|max:256'.($activity->name != $this->name ? '|unique:activities' : ''),
              'duration'=> 'required|numeric',
              'measure'=> 'required',
              'description'=> 'required',
              'type'=>'required',
              'hasforum'=>'required',
              'end'=>'required',
              'order'=> 'required',
          ];
        }elseif($this->type==='diagnostic'){
            return [
                //
                'name'=> 'required|max:256'.($activity->name != $this->name ? '|unique:activities' : ''),
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
            'name'=> 'required|max:256'.($activity->name != $this->name ? '|unique:activities' : ''),
            'duration'=> 'required|numeric',
            'measure'=> 'required',
            'description'=> 'required',
            'type'=>'required',
            'hasforum'=>'required',
            'order'=> 'required',
        ];
      }
    }
}
