<?php

namespace App\Controllers;

use Database\Connection;
use App\Interfaces\CrudInterface;
use App\Modules\Modules;
use App\Modules\ErrorsForm;

/**
 * class EventController
 * 
 * This class is the controller for working with the events table. 
 * In turn, it implements the crud interface CrudInterface
 * 
 * PHP version: 8.1
 * 
 * @author Jerobel Rodriguez <github.com/jerorguez>
 * @package App\Controllers
 * @license MIT
 * @version 1.0.0
 */
class EventController implements CrudInterface {

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
     * Displays all the resources in the event table.
     * 
     * @return void
     */
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
            $errorMsg = ErrorsForm::eventForm();

            if(empty($errorMsg))
                $this->store($_POST);
        }

        require('../views/events/createEvent.php');
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

        header('Location: myevents');

    }

    /**
     * CrudInterface's method (show)
     *
     * Returns the event from our database with the required id.
     * 
     * @param string $id
     * @return array
     */
    public function show(string $id) {
        $stm = $this->connection->prepare("SELECT * FROM events WHERE event_id = :id");
        $stm->execute([":id" => $id]);

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * CrudInterface's method (edit)
     *
     * Displays the form to edit an event table resource with the data filled 
     * in through the id. In case of passing the validations it calls the 
     * update() method. It is important to pass the id also through $_POST.
     * 
     * @param string $id
     * @return void
     */
    public function edit(string $id) : void {

        if(isset($_POST['edit'])) {
            $errorMsg = ErrorsForm::eventForm();

            if(empty($errorMsg))
                $this->update($_POST);
        }

        $editMode = true;
        $data = $this->show($id);
        require('../views/events/createEvent.php');
    }

    /**
     * CrudInterface's method (update)
     *
     * After editing a resource, this function is called to 
     * store the edited resource in the database.
     * 
     * @param array $data
     * @return void
     */
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

        header('Location: myevents');
    }

    /**
     * CrudInterface's method (destroy)
     * 
     * Removes the resource with that id from the database.
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id) : void {
        $stm = $this->connection->prepare("DELETE FROM events WHERE event_id = :id");
        $stm->execute([":id" => $id]);

        header('Location: myevents');
    }

    /**
     * Displays all events created by the logged in user.
     *
     * @return void
     */
    public function getCreatorEvents() {

        $stm = $this->connection->prepare("
            SELECT * FROM events
            WHERE creator_id LIKE :user_id
        ");

        $stm->execute([":user_id" => $_SESSION['id']]);
        $response = $stm->fetchAll(\PDO::FETCH_ASSOC);

        foreach($response as $key => $value) {
            $response[$key]['participants'] = $this->getParticipants($response[$key]['event_id']);
            $response[$key]['creator'] = $this->getCreatorName($response[$key]['creator_id']);
        }

        require('../views/events/myEvents.php');
    }

    /**
     * Returns the name of the creator of an event through 
     * its user id.
     *
     * @param string $user_id
     * @return string
     */
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

    /**
     * Returns the number of participants of an event through 
     * the event id.
     *
     * @param string $id
     * @return integer
     */
    public function getParticipants(string $id) : int {

        $stm = $this->connection->prepare("SELECT COUNT(user_id) as participants FROM participants WHERE event_id LIKE :id");
        $stm->execute([":id" => $id]);
        
        return $stm->fetch(\PDO::FETCH_ASSOC)['participants'];
    }

    /**
     * Inserts in the participants table the id of the event and the id of the 
     * logged in user. This way it is notified that the user is going to 
     * participate in that event.
     *
     * @param string $event_id
     * @return void
     */
    public function attend(string $event_id) : void {
        $stm = $this->connection->prepare("INSERT INTO participants VALUES (:event_id, :user_id)");

        $stm->bindValue(":event_id", $event_id, \PDO::PARAM_STR);
        $stm->bindValue(":user_id", $_SESSION['id'], \PDO::PARAM_STR);

        $stm->execute();

        header('Location: show');
    }

    /**
     * This method returns true if the logged in user is going to attend 
     * the event. The event id is required.
     *
     * @param string $event_id
     * @return boolean
     */
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

    /**
     * Displays all events to be attended by the logged in user.
     *
     * @return void
     */
    public function getAttendEvents() {
        
        $stm = $this->connection->prepare("SELECT * FROM events
        INNER JOIN participants
        ON participants.event_id = events.event_id
        WHERE participants.user_id = :user_id
        ");

        $stm->execute([":user_id" => $_SESSION['id']] );

        $response = $stm->fetchAll(\PDO::FETCH_ASSOC);

        foreach($response as $key => $value) {
            $response[$key]['participants'] = $this->getParticipants($response[$key]['event_id']);
            $response[$key]['creator'] = $this->getCreatorName($response[$key]['creator_id']);
        }
        
        require('../views/events/attendEvents.php');

    }

}