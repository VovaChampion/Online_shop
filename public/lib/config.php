<?php
class Db {
    
    // localhost
    private $host = 'localhost';
    private $db   = 'batman';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    
    protected $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
            $this->conn = new PDO($dsn, $this->user, $this->pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function connect(){
        return $this->conn;
    }
}