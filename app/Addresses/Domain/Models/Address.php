<?php

namespace App\Addresses\Domain\Models;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Countries\Domain\Models\Country;

class Address extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'address_1',
        'city',
        'postal_code',
        'country_id',
    ];

    /**
     * @return mixed
     */
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
