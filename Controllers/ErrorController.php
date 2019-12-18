<?php

namespace Controllers;

use App\Controller;
use App\View;

class ErrorController extends Controller
{

    function __construct()
    {
        $this->view = new View();
    }

    function error404()
    {
        $this->view->generate('404.php');
    }

}
