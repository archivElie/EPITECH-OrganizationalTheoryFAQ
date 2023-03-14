<?php

class EtnaDatabase {
    private $host = "localhost";
    private $port = "8080";
    private $username = "petitponey";
    private $password = 'lapls#mort@poney';
    private $database = "faqorgtheory";

    private $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            
            // Check if database exists, if not create it
            $this->conn->query("CREATE DATABASE IF NOT EXISTS {$this->database}");
            
            // Switch to the database
            $this->conn->query("USE {$this->database}");
        } catch (PDOException $ex) {
            exit("Connection failed: " . $ex->getMessage());
        }

        
    }

    public function createTable($table, $columns) {
        $sql = "CREATE TABLE IF NOT EXISTS $table ($columns);";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    public function read($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function update($table, $id, $data) {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ", ");
        $sql = "UPDATE $table SET $set WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute($data);
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function query ($sql) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }


}
