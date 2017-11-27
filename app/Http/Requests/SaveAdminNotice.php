<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveAdminNotice extends FormRequest
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
          'title'=> 'required|max:256|unique:notices',
          'description'=> 'required',
          'objective'=> 'required',
          'modality_results'=> 'required',
          'profile'=> 'required',
          'profile_eligibility_general'=> 'required',
          'profile_eligibility_particular'=>'required',
          'profile_eligibility_description'=>'required',
          'term_process'=>'required',
          'unforeseen_cases'=>'required',
          'contact'=>'required',
          'start'=>'required',
          'end'=>'required',
          'hasfiles'=>'required'
      ];
    }
}
