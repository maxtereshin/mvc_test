<?php

namespace Models;

use App\Model;

class Task extends Model
{

    const SHOW_BY_DEFAULT = 3;

    public function __construct() {
        parent::__construct();
        $this->table = "tasks";
    }

    function count()
    {
        try {
            $sql = "SELECT count(id) AS count FROM $this->table";
            $result = $this->db->prepare($sql);
            $result->execute();
            $row = $result->fetch();
            return $row['count'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    function all()
    {
        try {
            $sql = 'SELECT * FROM ' . $this->table;
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();
            return $rows;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    function allByFilter($page, $key, $sort)
    {
        try {
            $limit = self::SHOW_BY_DEFAULT;
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            $filter = " ORDER BY " . $key . " " . $sort;
            $sql = 'SELECT * FROM ' . $this->table . $filter . ' LIMIT :limit OFFSET :offset ';
            $result = $this->db->prepare($sql);
            $result->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $result->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $result->execute();
            $rows = $result->fetchAll();
            return $rows;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function save($name, $email, $description)
    {
        try {
            $sql = 'INSERT INTO ' . $this->table . ' (user_name, email, description) values (:name, :email, :description)';
            $result = $this->db->prepare($sql);
            $result->bindParam(':name', $name, \PDO::PARAM_STR);
            $result->bindParam(':email', $email, \PDO::PARAM_STR);
            $result->bindParam(':description', $description, \PDO::PARAM_LOB);
            $result->execute();
        } catch (\PDOException $e) {
            echo 'Error : ' . $e->getMessage();
            echo '<br/>Error sql : ' . "$sql";
            exit();
        }
    }

    public function update($id, $description)
    {
        try {
            $sql = 'UPDATE ' . $this->table . ' SET description=:description, updated=1 WHERE id = :id';
            $result = $this->db->prepare($sql);
            $result->bindParam(':description', $description, \PDO::PARAM_LOB);
            $result->bindParam(':id', $id, \PDO::PARAM_INT);
            $result->execute();
        } catch (\PDOException $e) {
            echo 'Error : ' . $e->getMessage();
            echo '<br/>Error sql : ' . "$sql";
            exit();
        }
    }

    public function updateStatus($id, $status)
    {
        try {
            $sql = 'UPDATE ' . $this->table . ' SET status=:status WHERE id = :id';
            $result = $this->db->prepare($sql);
            $result->bindParam(':status', $status, \PDO::PARAM_INT);
            $result->bindParam(':id', $id, \PDO::PARAM_INT);
            $result->execute();
        } catch (\PDOException $e) {
            echo 'Error : ' . $e->getMessage();
            echo '<br/>Error sql : ' . "$sql";
            exit();
        }
    }

}
