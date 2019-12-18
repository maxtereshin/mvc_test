<?php

namespace App;

use App\Router;
use Exceptions\InvalidRouteException;

class App
{

    public static $router;

    public static function init()
    {
        spl_autoload_register(['static', 'loadClass']);
        static::$router = new Router();
        try {
            static::$router->start();
        } catch (InvalidRouteException $e) {
            echo static::$router->action('Error', 'error404');
        }

    }

    public static function loadClass($className)
    {
        $className = str_replace('\\', DS, $className);
        $filePath = SITE_PATH . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return true;
        }
        return false;
    }

}