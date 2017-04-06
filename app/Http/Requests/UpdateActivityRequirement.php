<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use App\Models\ActivityRequirement;
class UpdateActivityRequirement extends FormRequest
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
      $requirement = ActivityRequirement::find($this->route("id"));
        return [
            //
            'name'=> 'required'.($requirement->name != $this->name ? '|unique:activity_requirements' : ''),
            'order'=> 'required|numeric',
            'material_link'=> 'url|nullable',
            'description'=> 'required',
        ];
    }
}
