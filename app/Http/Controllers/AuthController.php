<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentials;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class AuthController extends BaseController
{
    /**
     * @param Guard $auth
     * @param Request $request
     * @throws InvalidCredentials
     * @return array
     */
    public function token(Guard $auth, Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        /** @var AuthServiceInterface $authService */
        $authService = App::make(AuthServiceInterface::class);

        $token = $authService->getTokenForCredentials($auth, $credentials);

        return $token->toArray();
    }
}
