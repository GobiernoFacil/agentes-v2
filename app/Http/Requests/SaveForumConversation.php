<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ForumConversation;
use App\Traits\MessagesTrait;
class SaveForumConversation extends FormRequest
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
        if($this->topic){
          $slug         = str_slug($this->topic);
          $similar_slug = ForumConversation::where('slug',$slug)->first();
          if($similar_slug){
            return [
                    'similar_slug'=>'required',
                ];
          }else{
            return [
              //
              'topic'     => 'required|max:256|unique:forum_conversations',
              'description' => 'required',
            ];
          }
        }else{
          return [
            //
            'topic'     => 'required|max:256|unique:forum_conversations',
            'description' => 'required',
          ];
        }
    }
}
