<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use App\Models\Activity;
class SaveFellowEvaluation extends FormRequest
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

        $activity = Activity::where('slug',$this->route("activity_slug"))->first();
        $countP =1;
        $arr   = [];
        foreach ($activity->quizInfo->question as $question) {
           if(!$this->{'answer_q'.$countP}){
            return [
                'answer_q'.$countP =>'required'
             ];
           }
           if($question->count_correct($question->id)!=1 && count($this->{'answer_q'.$countP})!= $question->count_correct($question->id)){
             return [
                'answer_q'.$countP =>'array|between:'.$question->count_correct($question->id).','.$question->count_correct($question->id)
             ];
           }
           $countP++;
        }

       return [

      ];
    }
}
