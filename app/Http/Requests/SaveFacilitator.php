<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveFacilitator extends FormRequest
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
            //
            'name'     => 'required',
            'email'    => 'required|email|max:255|unique:users',
            'institution' => 'required',
            'image'    => 'file|mimes:jpg,png,jpeg|max:2500',
            'web'      => 'url|nullable',
            'facebook' => 'url|nullable',
            'linkedin' => 'url|nullable',
            'other'    => 'url|nullable'
        ];
    }
}
