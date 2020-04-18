<?php

namespace App\Users\Domain\Requests;

use App\App\Domain\Requests\APIRequest;

class LoginRequestForm extends APIRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
