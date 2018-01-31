<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveAdminNoticeFiles extends FormRequest
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

     if($this->file('filesData') && sizeof($this->file('filesData')) != 0 ){
        if(sizeof($this->file('filesData')) > 2){
            return [
              'comments'=> 'required',
              'limitNumber' => 'required'

            ];
        }else{
          return [
              //
              'comments'=> 'required',
              'filesData.*'   => 'required|mimes:doc,docx,pdf|max:2500'

          ];
        }
      }else{

        return [
            //
            'comments'=> 'required',
            'filesDataR'   => 'required'

        ];
      }
    }
}
