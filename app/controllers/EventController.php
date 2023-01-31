<?php

namespace App\Controllers;

use Database\Connection;
use App\Interfaces\CrudInterface;
use App\Modules\Modules;
use App\Modules\ErrorsForm;

class EventController implements CrudInterface {

    private static $instance;
    private $connection;

    public function __construct() {
        $this->connection = Connection::getInstance()->getConnection();
    }

    public static function getInstance() : self {
        return self::$instance ??= new self();
    }

    public function index() : void {

        $stm = $this->connection->prepare("SELECT * FROM events");
        $stm->execute();

        $response = $stm->fetchAll(\PDO::FETCH_ASSOC);
    
        foreach($response as $key => $value) {
            $response[$key]['participants'] = $this->getParticipants($response[$key]['event_id']);
            $response[$key]['creator'] = $this->getCreatorName($response[$key]['creator_id']);
            $response[$key]['attend'] = $this->willIAttend($response[$key]['event_id']);
        }

        require('../views/events/showEvents.php');
    }

    public function create() : void {
        require('../views/events/createEvent.php');
    }

    public function store(array $data) : void {

        $stm = $this->connection->prepare("INSERT INTO events (name, description, place, date, creator_id) VALUES (
            :name,
            :description,
            :place,
            :date,
            :creator_id
        )");

        $stm->bindValue("name", $data['name'], \PDO::PARAM_STR);
        $stm->bindValue("description", $data['description'], \PDO::PARAM_STR);
        $stm->bindValue("place", $data['place'], \PDO::PARAM_STR);
        $stm->bindValue("date", $data['date'], \PDO::PARAM_STR);
        $stm->bindValue("creator_id", $_SESSION['id'], \PDO::PARAM_INT);

        $stm->execute();

        header('Location: ../event/myevents');

    }

    public function show(string $id) {
        $stm = $this->connection->prepare("SELECT * FROM events WHERE event_id = :id");
        $stm->execute([":id" => $id]);

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }

    public function edit(string $id) : void {
        $editMode = true;
        $data = $this->show($id);
        require('../views/events/createEvent.php');
    }

    public function update(array $data) : void {

        $stm = $this->connection->prepare("UPDATE events SET
            name = :name,
            description = :description,
            place = :place,
            date = :date

        WHERE event_id = :id");

        $stm->bindValue("name", $data['name'], \PDO::PARAM_STR);
        $stm->bindValue("description", $data['description'], \PDO::PARAM_STR);
        $stm->bindValue("place", $data['place'], \PDO::PARAM_STR);
        $stm->bindValue("date", $data['date'], \PDO::PARAM_STR);
        $stm->bindValue(":id", $data['id'], \PDO::PARAM_INT);

        $stm->execute();

        header('Location: ../event/myevents');
    }

    public function destroy(string $id) : void {
        $stm = $this->connection->prepare("DELETE FROM events WHERE event_id = :id");
        $stm->execute([":id" => $id]);

        header('Location: ../app');
    }

    public function getCreatorEvents() {

        $stm = $this->connection->prepare("
            SELECT * FROM events
            WHERE creator_id LIKE :user_id
        ");

        $stm->execute([":user_id" => $_SESSION['id']]);
        $response = $stm->fetchAll(\PDO::FETCH_ASSOC);

        foreach($response as $key => $value) {
            $response[$key]['participants'] = $this->getParticipants($response[$key]['event_id']);
        }

        require('../views/events/myevents.php');
    }

    public function getCreatorName(string $user_id) : string {
        $stm = $this->connection->prepare("
            SELECT users.name, users.surname_1, users.surname_2, users.user_id FROM users
            INNER JOIN events
            ON users.user_id = events.creator_id
            WHERE users.user_id = :user_id
        ");

        $stm->execute([":user_id" => $user_id]);
        $response = $stm->fetch(\PDO::FETCH_ASSOC);

        return "{$response['name']} {$response['surname_1']} {$response['surname_2']}";
    }

    public function getParticipants(string $id) : int {

        $stm = $this->connection->prepare("SELECT COUNT(user_id) as participants FROM participants WHERE event_id LIKE :id");
        $stm->execute([":id" => $id]);
        
        return $stm->fetch(\PDO::FETCH_ASSOC)['participants'];
    }

    public function attend(string $event_id) : void {
        $stm = $this->connection->prepare("INSERT INTO participants VALUES (:event_id, :user_id)");

        $stm->bindValue(":event_id", $event_id, \PDO::PARAM_STR);
        $stm->bindValue(":user_id", $_SESSION['id'], \PDO::PARAM_STR);

        $stm->execute();

        header('Location: ../app');
    }

    public function willIAttend(string $event_id) : bool {

        $stm = $this->connection->prepare("SELECT 1 FROM participants 
            WHERE user_id = :user_id
            AND event_id = :event_id
        ");

        $stm->bindValue(":event_id", $event_id, \PDO::PARAM_STR);
        $stm->bindValue(":user_id", $_SESSION['id'], \PDO::PARAM_STR);

        $stm->execute();

        return !empty($stm->fetch(\PDO::FETCH_NUM));
    }

}