<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Traits\MessagesTrait;
class UpdateFacilitator extends FormRequest
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
      $user = User::find($this->route("id"));
      return [
      'name'     => 'required',
      'email'    => 'required|email|max:255' . ($user->email != $this->email ? '|unique:users' : ''),
      'institution' => 'required',
      'password' => 'min:8|nullable',
      'password-confirm'=>'same:password'
      ];
    }
}
