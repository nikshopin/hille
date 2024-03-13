<?php

namespace App\ShortUrl\Exceptions;

use Exception;

Class DataNotFoundException extends Exception
{
    protected $message = 'Data not found';
}
