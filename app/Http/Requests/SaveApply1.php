<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveApply1 extends FormRequest
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

      $words = explode(' ', $this->motives);
      $nbWords = count($words);
      if($nbWords > 400){
        return [
            //
            'motivesMax'=> 'required',
        ];
      }else {
        return [
            'motives'=> 'required',
        ];
      }

    }
}
