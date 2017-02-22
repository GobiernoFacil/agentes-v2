<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveAspirant extends FormRequest
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
      return [
        'name'     => 'required',
        'surname'     => 'required',
        'lastname'     => 'required',
        'email'    => 'required|email|max:255|unique:aspirants',
        'city'     => 'required',
        'state'     => 'required',
        'degree'     => 'required',
      ];
    }
}
