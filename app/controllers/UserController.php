<?php

namespace App\Controllers;

use Database\Connection;
use App\Interfaces\CrudInterface;
use App\Modules\Modules;
use App\Modules\ErrorsForm;

/**
 * class UserController
 * 
 * This class is the controller for working with the users table. 
 * In turn, it implements the crud interface CrudInterface
 * 
 * PHP version: 8.1
 * 
 * @author Jerobel Rodriguez <github.com/jerorguez>
 * @package App\Controllers
 * @license MIT
 * @version 1.0.0
 */
class UserController implements CrudInterface {

    private static $instance;
    private $connection;

    /**
     * __construct()
     * 
     * The constructor of this class when instantiated will take the 
     * instance of the Connection class and will store in the variable 
     * $connection the connection to the database.
     * 
     */
    public function __construct() {
        $this->connection = Connection::getInstance()->getConnection();
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
     * CrudInterface's method (index)
     *
     * We are not interested in knowing all the users, so when we 
     * try to access through the router, we are returned to page 404.
     * 
     * @return void
     */
    public function index() : void {
        header('Location: 404');
    }

    /**
     * CrudInterface's method (create)
     *
     * Displays the form for the insertion of a new resource, if the $_POST 
     * does not pass the validations it returns an error in the html, 
     * otherwise it proceeds to store them.
     * 
     * @return void
     */
    public function create() : void {

        if($_POST) {
            $errorMsg = ErrorsForm::userForm();

            if(empty($errorMsg))
                $this->store($_POST);
        }

        require('../views/users/createUser.php');
    }

    /**
     * CrudInterface's method (store)
     *
     * Stores the new recourse in the database, this method is called by create().
     * 
     * @param array $data
     * @return void
     */
    public function store(array $data) : void {

        $stm = $this->connection->prepare("INSERT INTO users (name, surname_1, surname_2, email, password) VALUES (
            :name,
            :surname_1,
            :surname_2,
            :email,
            :password
        )");

        $stm->bindValue(":name", strtolower($data['name']), \PDO::PARAM_STR);
        $stm->bindValue(":surname_1", strtolower($data['surname_1']), \PDO::PARAM_STR);
        $stm->bindValue(":surname_2", empty($data['surname_2']) ? null : strtolower($data['username_2']), \PDO::PARAM_STR);
        $stm->bindValue(":email", strtolower($data['email']), \PDO::PARAM_STR);
        $stm->bindValue(":password", Modules::hashPasswd($data['password']), \PDO::PARAM_STR);

        $stm->execute();

        header("refresh: 0; url = ../index");

    }

    /**
     * CrudInterface's method (show)
     *
     * Returns the user from our database with the required id.
     * 
     * @param string $id
     * @return array
     */
    public function show(string $id) : array {

        $stm = $this->connection->prepare("SELECT * FROM users WHERE user_id = :id");
        $stm->execute([":id" => $id]);

        return $stm->fetch(\PDO::FETCH_ASSOC);

    }

    /**
     * CrudInterface's method (edit)
     *
     * Not required in this program
     * 
     * @param string $id
     * @return void
     */
    public function edit(string $id) : void {}

    /**
     * CrudInterface's method (update)
     *
     * Not required in this program
     * 
     * @param array $data
     * @return void
     */
    public function update(array $data) : void {}

    /**
     * CrudInterface's method (destroy)
     * 
     * Removes the resource with that id from the database.
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id) : void {

        $stm = $this->connection->prepare("DELETE FROM users WHERE user_id = :id");
        $stm->execute([":id" => $id]);

    }

    /**
     * Verify if the email passed by parameters already exists in 
     * our database. Returns true if found.
     *
     * @param string $email
     * @return boolean
     */
    public function checkEmailExist(string $email) : bool {
        $stm = $this->connection->prepare("SELECT email FROM users WHERE email = :email");
        $stm->execute([":email" => $email]);

        return !empty($stm->fetch(\PDO::FETCH_ASSOC));
    }

    /**
     * Returns a user's data via email
     *
     * @param string $email
     * @return array
     */
    public function checkByEmail(string $email) : array {

        $stm = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stm->execute([":email" => $email]);

        return $stm->fetch(\PDO::FETCH_ASSOC);

    }

}