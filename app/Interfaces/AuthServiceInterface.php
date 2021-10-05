<?php

namespace App\Interfaces;

use App\Exceptions\InvalidCredentials;
use Illuminate\Contracts\Auth\Guard;

interface AuthServiceInterface
{
    /**
     * @param Guard $auth
     * @param array $credentials
     * @throws InvalidCredentials
     * @return DtoInterface
     */
    public function getTokenForCredentials(Guard $auth, array $credentials): DtoInterface;
}
