<?php

class DBHelper
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function executeQuery($query)
    {
        try {
            $stmt = $this->conn->query($query);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query execution failed: " . $e->getMessage());
        }
    }

    public function executeQueryAll($query)
    {
        try {
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query execution failed: " . $e->getMessage());
        }
    }

    public function rollback()
    {
        $this->conn->rollBack();
    }

    public function beginTransaction()
    {
        $this->conn->beginTransaction();
    }

    public function setAttribute($attribute, $value)
    {
        $this->conn->setAttribute($attribute, $value);
    }

    public function prepare($sql)
    {
        return $this->conn->prepare($sql);
    }

    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function escapeString($string)
    {
        return $this->conn->quote($string);
    }
}
?>
