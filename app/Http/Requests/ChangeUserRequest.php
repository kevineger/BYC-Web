<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class ChangeUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->route('users');

        return Auth::user() == $user;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'required|mimes:jpeg,jpg,tiff,gif,bmp,png'
        ];
    }
}
