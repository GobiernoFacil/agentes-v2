<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class UpdateAspirantProfile extends FormRequest
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
              'password' => 'min:8|nullable',
              'password-confirm'=>'same:password',
              'image'    => 'file|mimes:jpg,png,jpeg|max:2500',
       ];
    }
}
