<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class LdapUserBindError extends Exception
{
    protected $message = "Error while binding user to LDAP server, check your email/password.";
}
