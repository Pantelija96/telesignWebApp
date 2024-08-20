<?php

namespace App\Exceptions;

use Exception;

class UserNotFound extends Exception
{
    protected $message = "User is not found!";
}
