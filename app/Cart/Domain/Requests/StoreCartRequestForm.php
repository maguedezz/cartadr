<?php

namespace App\Cart\Domain\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequestForm extends FormRequest
{
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
            'products' => 'required|array',
            'products.*.id' => 'required|exists:product_variations,id', // exist within productvariations table under the id column
            'products.*.quantity' => 'numeric|min:1',
        ];
    }
}
