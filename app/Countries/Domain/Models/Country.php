<?php

namespace App\Countries\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * @var mixed
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
    ];
}
