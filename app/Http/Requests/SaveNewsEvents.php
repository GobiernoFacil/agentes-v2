<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveNewsEvents extends FormRequest
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

      if($this->type==='news' || $this->type==='fellow'){
        return [
            //
            'title'=> 'required|max:256|unique:news_events',
            'content'=> 'required',
            'type'=>'required',
            'public'=>'required',
            'image'    => 'file|mimes:jpg,png,jpeg|max:2500',
            'brief' => 'required',
        ];
      }elseif($this->type==='notice'){
        return [
            //
            'title'=> 'required|max:256|unique:news_events',
            'content'=> 'required',
            'type'=>'required',
            'public'=>'required',
            'image'    => 'file|mimes:jpg,png,jpeg|max:2500',
            'brief' => 'required',
            'program_id' => 'required'
        ];

      }else{
        return [
            //
            'title'=> 'required|max:256|unique:news_events',
            'content'=> 'required',
            'start'=> 'required',
            'end'=> 'required',
            'time'=> 'required',
            'type'=>'required',
            'public'=>'required',
            'image'    => 'file|mimes:jpg,png,jpeg|max:2500',
            'brief' => 'required',
        ];
      }
    }
}
