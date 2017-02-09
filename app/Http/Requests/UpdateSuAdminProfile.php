<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Traits\MessagesTrait;
class UpdateSuAdminProfile extends FormRequest
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
      $user = Auth::user();
      return [
      'name'     => 'required',
      'email'    => 'required|email|max:255' . ($user->email != $this->email ? '|unique:users' : ''),
      'password' => 'min:8|nullable',
      'password-confirm'=>'same:password'
      ];
    }
}
