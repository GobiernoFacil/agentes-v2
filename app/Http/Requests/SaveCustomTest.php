<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use App\Models\Activity;
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
      if(isset($this->session_id)){
        if($this->session_id){
          $questionnaire = CustomQuestionnaire::where('type','facilitator')->first();
        }else{
          $questionnaire = CustomQuestionnaire::where('slug',$this->route("slug"))->first();
        }
      }elseif($this->route("activity_slug")){
          $activity      = Activity::where('slug',$this->route("activity_slug"))->first();
          $questionnaire = $activity->diagnosticInfo;
      }else{
        return [
          'ushallntpass.required' => 'required'
        ];
      }

      $countP =1;
      foreach ($questionnaire->questions as $question) {
         if($question->options_rows_number > 1){
            foreach ($question->answers as $answer) {
              if(!$this->{'question_'.$countP.'_'.$question->id.'_'.$answer->id} && $question->required){
               return [
                   "question_".$countP."_".$question->id.'_'.$answer->id.".required"=>'Contesta esta pregunta'
                ];
              }elseif($countP == $questionnaire->questions->count()){
                return [
                  "question_algo.required" => 'hi'
                ];
              }
            }
         }else{
           if(!$this->{'question_'.$countP.'_'.$question->id}){
            return [
                "question_".$countP."_".$question->id.".required"=>'Contesta esta pregunta'
             ];
           }elseif($countP == $questionnaire->questions->count()){
             return [
               "question_algo.required" => 'hi'
             ];
           }
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
      if(isset($this->session_id)){
        if($this->session_id){
          $questionnaire = CustomQuestionnaire::where('type','facilitator')->first();
        }else{
          $questionnaire = CustomQuestionnaire::where('slug',$this->route("slug"))->first();
        }
      }elseif($this->route("activity_slug")){
          $activity      = Activity::where('slug',$this->route("activity_slug"))->first();
          $questionnaire = $activity->diagnosticInfo;
      }else{
        return [
          'ushallntpass' => 'required'
        ];
      }

      $countP =1;
      foreach ($questionnaire->questions as $question) {
        if($question->type === 'open'){
            if($question->required){
              if(!$this->{'question_'.$countP}){
               return [
                   'question_'.$countP =>'required'
                ];
              }
            }
        }elseif($question->type ==='radio'){

          if($question->required){
              if($question->options_rows_number > 1){
                foreach ($question->answers as $answer) {
                  if(!$this->{'question_'.$countP.'_'.$question->id.'_'.$answer->id} && $question->required){
                      return [
                          'question_'.$countP.'_'.$question->id.'_'.$answer->id =>'required'
                       ];
                     }
                   }

                }else{
                    if(!$this->{'question_'.$countP.'_'.$question->id} && $question->required){
                     return [
                         'question_'.$countP.'_'.$question->id =>'required'
                      ];
                    }
                  }
          }


        }elseif($question->type === 'answers'){
          if($question->required){
            if(!$this->{'question_'.$countP}){
             return [
                 'question_'.$countP =>'required'
              ];
            }

            if($question->count_correct($question->id)!=1 && count($this->{'question_'.$countP})!= $question->count_correct($question->id) &&$question->count_correct($question->id)>0){
              return [
                 'question_'.$countP =>'array|between:'.$question->count_correct($question->id).','.$question->count_correct($question->id)
              ];
            }
          }

        }else{
          return [

          ];
        }
         $countP++;
      }
      return [

      ];
    }
}
