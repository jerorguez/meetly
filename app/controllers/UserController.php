<?php

namespace App\Controllers;

use Database\Connection;
use App\Interfaces\CrudInterface;
use App\Modules\Modules;
use App\Modules\ErrorsForm;

class UserController implements CrudInterface {

    private static $instance;
    private $connection;

    public function __construct() {
        $this->connection = Connection::getInstance()->getConnection();
    }

    public static function getInstance() : self {
        return self::$instance ??= new self();
    }

    public function index() : void {
        header('Location: 404');
    }

    public function create() : void {

        if($_POST) {
            $errorMsg = ErrorsForm::userForm();

            if(empty($errorMsg))
                $this->store($_POST);
        }

        require('../views/users/createUser.php');
    }

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

    public function show(string $id) {

        $stm = $this->connection->prepare("SELECT * FROM users WHERE user_id = :id");
        $stm->execute([":id" => $id]);

        return $stm->fetch(\PDO::FETCH_ASSOC);

    }

    public function edit(string $id) : void {}

    public function update(array $data) : void {}

    public function destroy(string $id) : void {

        $stm = $this->connection->prepare("DELETE FROM users WHERE user_id = :id");
        $stm->execute([":id" => $id]);

    }

    public function checkEmailExist(string $email) : bool {
        $stm = $this->connection->prepare("SELECT email FROM users WHERE email = :email");
        $stm->execute([":email" => $email]);

        return !empty($stm->fetch(\PDO::FETCH_ASSOC));
    }

    public function checkByEmail(string $email) : array {

        $stm = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stm->execute([":email" => $email]);

        return $stm->fetch(\PDO::FETCH_ASSOC);

    }

}