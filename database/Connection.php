<?php

namespace Database;

/**
 * class Connection
 * 
 * This class instantiates the connection to our database.
 * 
 * PHP version: 8.1
 * 
 * @author Jerobel Rodriguez <github.com/jerorguez>
 * @package Database
 * @license MIT
 * @version 1.0.0
 */
class Connection {

    private static $instance;
    private $connection;

    public function __construct() {
        $this->setConnection();
    }

    /**
     * Singleton for Isntance
     * 
     * Returns the instance if it is already created and stores 
     * it in $instance, otherwise it creates it.
     *
     * @return self
     */
    public static function getInstance() : self {
        return self::$instance ??= new self();
    }

    /**
     * Setter method to create a new PDO object
     *
     * @return void
     */
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

    /**
     * Getter method to return the connection stored in $connection
     *
     * @return object
     */
    public function getConnection() : object {
        return $this->connection;
    }

};