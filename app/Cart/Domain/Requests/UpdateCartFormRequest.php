<?php

namespace App\Cart\Domain\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'quantity' => 'required|min:1|numeric',
        ];
    }
}
