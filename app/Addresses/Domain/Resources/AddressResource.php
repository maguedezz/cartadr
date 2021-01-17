<?php

namespace App\Addresses\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Countries\Domain\Resources\CountryResource;

class AddressResource extends JsonResource
{
    /**
     * @param $request
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address_1' => $this->address_1,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'country' => new CountryResource($this->country),
            'default' => $this->default,
        ];
    }
}
