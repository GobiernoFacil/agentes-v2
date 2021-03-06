<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use App\Models\ModuleSession;
class UpdateSession extends FormRequest
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
        $session = ModuleSession::find($this->route("session_id"));
        return [
          'name'=> 'required|max:256'.($session->name != $this->name ? '|unique:module_sessions' : ''),
          'parent_id'=> 'required',
        /*  'hours'=> 'required|numeric',
          'modality'=> 'required',
          'objective'=> 'required',
          'start'=> 'required',
          'end'=> 'required',*/
        ];
    }
}
