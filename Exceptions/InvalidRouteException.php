<?php

namespace Exceptions;

class InvalidRouteException extends \Exception
{

    public function __construct()
    {
        \Exception::__construct('Не найден маршрут');
    }

}