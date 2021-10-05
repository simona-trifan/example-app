<?php

namespace App\Services;

use App\Dto\TokenDto;
use App\Exceptions\InvalidCredentials;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\DtoInterface;
use Illuminate\Contracts\Auth\Guard;

class AuthService implements AuthServiceInterface
{
    /**
     * @param Guard $auth
     * @param array $credentials
     * @return DtoInterface
     * @throws InvalidCredentials
     */
    public function getTokenForCredentials(Guard $auth, array $credentials): DtoInterface
    {
        if (!$this->validateCredentials($credentials)) {
            throw new InvalidCredentials();
        }

        if (!$auth->attempt($credentials)) {
            throw new InvalidCredentials();
        }

        return new TokenDto($auth->issue());
    }

    /**
     * @param array $credentials
     * @return bool
     */
    protected function validateCredentials(array $credentials): bool
    {
        return count(array_intersect(array_keys($credentials), ['email', 'password'])) === 2;
    }
}
