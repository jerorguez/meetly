<?php

namespace Database;

class Connection {

    private static $instance;
    private $connection;

    public function __construct() {
        $this->setConnection();
    }

    public static function getInstance() : self {
        return self::$instance ??= new self();
    }

    private function setConnection() : void {

        try {
            
            $connection = new \PDO("mysql:host={$_ENV['DB_HOST']}; dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASS']);
    
            $setNames = $connection->prepare("SET NAMES 'utf8'");
            $setNames->execute();
    
            $this->connection = $connection;

        } catch(\PDOException $e){
            die($e->getMessage());
        }

    }

    public function getConnection() : object {
        return $this->connection;
    }

};