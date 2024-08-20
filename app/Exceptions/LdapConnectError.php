<?php

namespace App\Exceptions;

use Exception;

class LdapConnectError extends Exception
{
    protected $message = "Error while connecting to LDAP server.";
}
