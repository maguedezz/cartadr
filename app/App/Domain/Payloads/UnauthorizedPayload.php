<?php

namespace App\App\Domain\Payloads;

class UnauthorizedPayload extends Payload
{
    /**
     * @var array
     */
    protected $data = ['message' => 'unauthorized attempt.'];

    /**
     * @var int
     */
    protected $status = 401;
}
