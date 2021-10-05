<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentials extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Invalid credentials';

    /**
     * @var int
     */
    protected $code = 401;
}
