<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveFiles extends FormRequest
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
        'cv' => 'required|file|mimes:doc,docx,pdf|max:2500',
        'essay' => 'required|file|mimes:doc,docx,pdf|max:25000',
        'letter' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2500',
        'proof' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2500',
        'privacy' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2500',
        'video' => 'required',
      //  'aId'=>'required'
      ];
    }
}
