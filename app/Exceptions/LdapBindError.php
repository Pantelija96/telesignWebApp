<?php

namespace App\Exceptions;

use Exception;

class LdapBindError extends Exception
{
    protected $message = "Error while binding to LDAP server.";
}
