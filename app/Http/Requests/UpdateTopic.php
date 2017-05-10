<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
use App\Models\Topic;
class UpdateTopic extends FormRequest
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
      $topic = Topic::find($this->route("id"));
        return [
            //
            'name'=> 'required|max:256'.($topic->name != $this->name ? '|unique:topics' : ''),
            'order'=> 'required|numeric',
        ];
    }
}
