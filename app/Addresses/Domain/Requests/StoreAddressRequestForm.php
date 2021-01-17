<?php

namespace App\Addresses\Domain\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequestForm extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'postal_code' => 'required|exists:countries,id',
            'default' => 'nullable|boolean',
        ];
    }
}
