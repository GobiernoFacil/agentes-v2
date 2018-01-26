<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MessagesTrait;
class SaveApply2 extends FormRequest
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

            //
            return [
                'email'=> 'required|email',
                'age'  =>  'required|integer',
                'phone'=>  'required|numeric|digits:10',
                'mobile'=>  'required|numeric|digits:10',
                'semester' => 'required',
                'status'  => 'required'
            ];

    }
}
