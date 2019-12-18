<?php

namespace Controllers;

use App\Controller;
use App\View;
use Models\Task;
use Utils\Pagination;

class MainController extends Controller
{
    public $errors = array();

    function __construct()
    {
        $this->view = new View();
        $this->model = new Task();
    }

    function index()
    {
        if (isset($_POST['submit'])) {
            $name = $this->prepareData("name", $_POST['name']);
            $email = $this->prepareData("email", $_POST['email']);
            $description = $this->prepareData("description", $_POST['description']);
            if ($name && $email && $description) {
                $this->model->save($name, $email, $description);
                $data["added"] = true;
            }
        }

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = intval($page);
        if (!$page) {
            $page = 1;
        }

        $key = $sort = false;
        $key_array = ['user_name', 'email', 'status'];
        $sort_array = ['desc', 'asc'];

        if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
            $sort = $_GET['sort'];
        }
        if (isset($_GET['key']) && in_array($_GET['key'], $key_array)) {
            $key = $_GET['key'];
        }
        if ($key && $sort) {
            $filter = "&key=" . $key . "&sort=" . $sort;
        } else {
            $filter = "";
            $key = 'id';
            $sort = 'asc';
        }

        $data["page"] = $page;
        $data["tasks"] = $this->model->allByFilter($page, $key, $sort);
        $total = $this->model->count();
        $data['pagination'] = new Pagination($total, $page, Task::SHOW_BY_DEFAULT, $filter);
        $data["errors"] = $this->errors;
        $this->view->generate('tasks.php', $data);

    }

    function prepareData($field, $value)
    {
        if (!isset($value) || strlen($value) == 0) {
            $this->errors[] = "Не заполнено поле " . $field;
            return false;
        }
        $value = htmlspecialchars($value);
        if ($field == 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->errors[] = "Email указан неверно";
            }
        }
        return $value;
    }
}
