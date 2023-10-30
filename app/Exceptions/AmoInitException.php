<?php

namespace App\Exceptions;

use Exception;

class AmoInitException extends Exception
{
    protected $message = 'Ошибка инициализации AmoCRM';
}
