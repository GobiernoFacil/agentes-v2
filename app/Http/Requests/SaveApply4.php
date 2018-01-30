<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use Auth;
class SaveApply4 extends FormRequest
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
        if($user->aspirant($user)->AspirantsFile->proof){
          return [
            'proof' => 'file|mimes:jpg,png,jpeg,pdf|max:2500',
          ];

        }else{
          return [
                  //
                  'proof' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2500',
              ];
        }


    }
}
