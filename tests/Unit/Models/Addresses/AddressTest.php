<?php

namespace Tests\Unit\Models\Addresses;

use Tests\TestCase;
use App\Users\Domain\Models\User;
use App\Addresses\Domain\Models\Address;
use App\Countries\Domain\Models\Country;

class AddressTest extends TestCase
{
    public function test_it_belongs_to_a_user()
    {
        $address = factory(Address::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(Country::class, $address->country);
    }

    public function test_it_has_one_country()
    {
        $address = factory(Address::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(Country::class, $address->country);
    }
}
