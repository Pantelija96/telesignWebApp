<?php

namespace App\Exceptions;

use Exception;

class RecordsNotInserted extends Exception
{
    protected $message = "Some error occurred while inserting records to db!";
}
