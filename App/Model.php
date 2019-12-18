<?php

namespace App;

use PDO;

abstract class Model
{

    protected $db;
    protected $table;

    public function __construct()
    {
        $settings = $this->getPDOSettings();
        $this->db = new PDO($settings['dsn'], $settings['user'], $settings['pass'], $settings['opt']);
    }

    protected function getPDOSettings()
    {
        $result['dsn'] = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $result['user'] = DB_USER;
        $result['pass'] = DB_PASS;
        $result['opt'] = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        return $result;
    }

}