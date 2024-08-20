<?php

namespace App\Exceptions;

class RecordsFileNotValid extends \Exception
{
    protected $message = "File not uploaded, or file in invalid format!";
}
