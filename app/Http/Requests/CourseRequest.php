<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CourseRequest extends Request {

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
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'max_age'     => 'required_unless:all_ages, 1|numeric|min:' . Request::get('min_age'),
        ];
    }

    public function messages(){
        $messages = [
            'min_age.required_unless' => 'Minimum Age Required',
            'max_age.required_unless' => 'Maximum Age Required',
            'max_age.min' => 'Maximum age must be greater than or equal to the minimum age',

        ];
        return $messages;
    }

}
