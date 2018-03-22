<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveAdminForum extends FormRequest
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

      if($this->type){
        if($this->type === 'state'){
          return [
            'topic'     => 'required|max:256|unique:forums',
            'description' => 'required',
            'state'      => 'required'
          ];
        }elseif ($this->type === 'activity') {
          return [
            'topic'     => 'required|max:256|unique:forums',
            'description' => 'required',
            'session_id'      => 'required',
            'activity_id'      => 'required'
          ];
        }else{
          return [
            'topic'     => 'required|max:256|unique:forums',
            'description' => 'required',
          ];
        }

      }else{
        return [
          'topic'     => 'required|max:256|unique:forums',
          'description' => 'required',
          'type'      => 'required'
        ];
      }

    }
}
