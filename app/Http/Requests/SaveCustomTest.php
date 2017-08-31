<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use App\Models\CustomQuestionnaire;
class SaveCustomTest extends FormRequest
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

    public function messages()
    {
      $questionnaire = CustomQuestionnaire::where('slug',$this->route("slug"))->first();
      $countP =1;
      foreach ($questionnaire->questions as $question) {
        if(!$this->{'question_'.$countP.'_'.$question->id}){
         return [
             "question_".$countP."_".$question->id.".required"=>'Contesta esta pregunta'
          ];
        }elseif($countP == $questionnaire->questions->count()){
          return [
            "question_algo.required" => 'hi'
          ];
        }
         $countP++;
      }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

      $questionnaire = CustomQuestionnaire::where('slug',$this->route("slug"))->first();
      $countP =1;
      foreach ($questionnaire->questions as $question) {
        if(!$this->{'question_'.$countP.'_'.$question->id}){
         return [
             'question_'.$countP.'_'.$question->id =>'required'
          ];
        }
         $countP++;
      }
        return [
            //
        ];
    }
}
