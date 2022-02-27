<?php

namespace App\Exceptions;

use Exception;

class DefaultException extends Exception
{
    function report()
    {
            //
    }

    function render()
    {
    return view('errors.default');
    }
}
