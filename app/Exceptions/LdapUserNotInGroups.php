<?php

namespace App\Exceptions;

use Exception;

class LdapUserNotInGroups extends Exception
{
    protected $message = "User is not found in required groups!";
}
