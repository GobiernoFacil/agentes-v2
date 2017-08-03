<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveSatisfactionSurvey extends FormRequest
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
      if($this->sur_8){
        $val_a = current(array_slice($this->sur_8, 0, 1));
      }else{
        $val_a =null;
      }
      if($val_a ==1){
        return [
            //
            'sur_1'=>'required',
            'sur_j1'=>'required',
            'sur_2'=>'required',
            'sur_j2'=>'required',
            'sur_3_1'=>'required',
            'sur_3_2'=>'required',
            'sur_3_3'=>'required',
            'sur_3_4'=>'required',
            'sur_3_5'=>'required',
            'sur_4'=>'required',
            'sur_5_1'=>'required',
            'sur_5_2'=>'required',
            'sur_5_3'=>'required',
            'sur_5_4'=>'required',
            'sur_6_1'=>'required',
            'sur_6_2'=>'required',
            'sur_6_3'=>'required',
            'sur_7_1'=>'required',
            'sur_7_2'=>'required',
            'sur_7_3'=>'required',
            'sur_8'=>'required',
            'sur_j8'=>'required',
            'sur_9'=>'required',
            'sur_j9'=>'required',
            'sur_10'=>'required',
            'sur_j10'=>'required',
            'sur_11'=>'required',
            'sur_j12'=>'required',
            'sur_13_1'=>'required',
            'sur_13_2'=>'required',
            'sur_13_3'=>'required',
            'sur_13_4'=>'required',
            'sur_14_1'=>'required',
            'sur_14_2'=>'required',
            'sur_14_3'=>'required',
            'sur_14_4'=>'required',
            'sur_15_1'=>'required',
            'sur_15_2'=>'required',
            'sur_15_3'=>'required',
            'sur_15_4'=>'required',
            'sur_16_1'=>'required',
            'sur_16_2'=>'required',
            'sur_16_3'=>'required',
            'sur_16_4'=>'required',
        ];
      }else{
        return [
            //
            'sur_1'=>'required',
            'sur_j1'=>'required',
            'sur_2'=>'required',
            'sur_j2'=>'required',
            'sur_3_1'=>'required',
            'sur_3_2'=>'required',
            'sur_3_3'=>'required',
            'sur_3_4'=>'required',
            'sur_3_5'=>'required',
            'sur_4'=>'required',
            'sur_5_1'=>'required',
            'sur_5_2'=>'required',
            'sur_5_3'=>'required',
            'sur_5_4'=>'required',
            'sur_6_1'=>'required',
            'sur_6_2'=>'required',
            'sur_6_3'=>'required',
            'sur_7_1'=>'required',
            'sur_7_2'=>'required',
            'sur_7_3'=>'required',
            'sur_8'=>'required',
            'sur_9'=>'required',
            'sur_j9'=>'required',
            'sur_10'=>'required',
            'sur_j10'=>'required',
            'sur_11'=>'required',
            'sur_j12'=>'required',
            'sur_13_1'=>'required',
            'sur_13_2'=>'required',
            'sur_13_3'=>'required',
            'sur_13_4'=>'required',
            'sur_14_1'=>'required',
            'sur_14_2'=>'required',
            'sur_14_3'=>'required',
            'sur_14_4'=>'required',
            'sur_15_1'=>'required',
            'sur_15_2'=>'required',
            'sur_15_3'=>'required',
            'sur_15_4'=>'required',
            'sur_16_1'=>'required',
            'sur_16_2'=>'required',
            'sur_16_3'=>'required',
            'sur_16_4'=>'required',
        ];
      }
    }
}
