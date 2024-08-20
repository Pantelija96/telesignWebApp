<?php

namespace App\Exceptions;

use Exception;

class RecordNotEdited extends Exception
{
    protected $message = "Error while editing record!";
}
