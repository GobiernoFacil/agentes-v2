<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use App\Models\Module;
class UpdateModule extends FormRequest
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
        $module = Module::find($this->route("module_id"));
        return [
            //
            'title'=> 'required|max:256'.($module->title != $this->title ? '|unique:modules' : ''),
            'number_sessions'=> 'required|numeric',
            'number_hours'=> 'required|numeric',
            'modality'=> 'required',
            'teaching_situation'=> 'required',
            'product_developed'=> 'required',
            'start'=> 'required',
            'end'=> 'required',
            'public'=> 'required',
            'measure'=> 'required',
        ];
    }
}
