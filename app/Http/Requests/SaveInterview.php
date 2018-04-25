<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use App\Models\Notice;
class SaveInterview extends FormRequest
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
      $notice  = Notice::where('id',$this->route("notice_id"))->firstOrFail();
      $questionnaire = $notice->interview_questionnaire;
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
      $notice  = Notice::where('id',$this->route("notice_id"))->firstOrFail();
      $questionnaire = $notice->interview_questionnaire;
      $countP =1;
      foreach ($questionnaire->questions as $question) {
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

         $countP++;
      }
        return [
            //
        ];
    }
}
