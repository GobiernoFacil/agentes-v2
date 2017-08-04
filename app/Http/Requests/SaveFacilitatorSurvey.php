<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveFacilitatorSurvey extends FormRequest
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
            'fa_1'=>'required',
            'fa_2'=>'required',
            'fa_3'=>'required',
            'fa_4'=>'required',
            'fa_5'=>'required',
            'fa_6'=>'required',
            'fa_7'=>'required',
            'fa_8'=>'required',
            'fa_9'=>'required',
        ];
    }
}
