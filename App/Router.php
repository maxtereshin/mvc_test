<?php

namespace App;

use Exceptions\InvalidRouteException;

class Router
{

    public $defaultControllerName = 'main';
    public $defaultActionName = "index";

    public function start()
    {
        if (($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false) {
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        } else {
            $route = $_SERVER['REQUEST_URI'];
        }
        $route = explode('/', $route);

        !empty($route[1]) ? $controllerName = $route[1] : $controllerName = $this->defaultControllerName;
        !empty($route[2]) ? $actionName = $route[2] : $actionName = $this->defaultActionName;

        $this->action($controllerName, $actionName);
    }

    public function action($controllerName, $actionName)
    {
        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName);
        $controllerFile = SITE_PATH . 'Controllers' . DS . $controllerName . 'Controller.php';
        if (!file_exists($controllerFile)) {
            throw new InvalidRouteException();
        }
        require_once $controllerFile;
        $controllerClass = "\\Controllers\\" . $controllerName . "Controller";
        if (!class_exists($controllerClass)) {
            throw new InvalidRouteException();
        }
        $controller = new $controllerClass;
        if (!method_exists($controller, $actionName)) {
            throw new InvalidRouteException();
        }
        $controller->$actionName();
    }

}