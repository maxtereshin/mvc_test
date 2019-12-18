<?php

namespace Controllers;

use App\Controller;
use App\View;
use Models\Task;

class AdminController extends Controller
{

    function __construct()
    {
        $this->view = new View();
        $this->model = new Task();
    }

    function index()
    {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['admin'] == "123" )
        {
            if (isset($_POST['submit'])) {
                $id = $this->prepareData("id", $_POST['id']);
                $description = $this->prepareData("description", $_POST['description']);
                $status = isset($_POST['status']) ? 1 : 0;
                if ($id && $description) {
                    $this->model->update($id, $description);
                }
            }

            if (isset($_GET['status']) && isset($_GET['id'])) {
                $status = $_GET['status'];
                $id = $_GET['id'];
                $this->model->updateStatus($id, $status);
                echo 'Update success';
                exit();
            }

            $data["tasks"] = $this->model->all();
            $this->view->generate('admin.php', $data);
        }
        else
        {
            session_destroy();
            header('Location:/admin/login');
        }
    }

    function login()
    {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['admin'] == "123" )
        {
            header('Location:/admin');
        }
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            if ($login == "admin" && $password == "123") {
                $data["login_status"] = "access_granted";

                $_SESSION['admin'] = $password;
                header('Location:/admin');
            } else {
                $data["login_status"] = "access_denied";
            }
        } else {
            $data["login_status"] = "";
        }
        $this->view->generate('login.php', $data);
    }

    function logout()
    {
        session_start();
        session_destroy();
        header('Location:/');
    }

    function prepareData($field, $value)
    {
        if (!isset($value) || strlen($value) == 0) {
            return false;
        }
        return $value;
    }

}
