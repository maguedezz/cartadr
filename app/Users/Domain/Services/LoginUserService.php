<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Services\BaseService;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\UnauthorizedPayload;
use App\Users\Domain\Repositories\UserRepository;

class LoginUserService extends BaseService
{
    /**
     * @var mixed
     */
    private $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param array $data
     */
    public function handle($data = [])
    {
        if (!$token = auth()->attempt($data)) {
            return new UnauthorizedPayload([
                'errors' => [['email' => 'Could not sign you in with those details'],
                ],
            ]);
        }

        return new GenericPayload($token);
    }
}
