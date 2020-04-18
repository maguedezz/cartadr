<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\BaseService;
use App\Users\Domain\Repositories\UserRepository;

class RegisterUserService extends BaseService
{
    protected $users;
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    public function handle($request = [])
    {
        return new GenericPayload($this->users->create($request));
    }
}