<?php
class Event {

    private $conn;
    private $table = "event";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all events
    public function getAllEvents() {
        $query = "SELECT * FROM " . $this->table . " WHERE date_time > NOW() ORDER BY date_time";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Fetch all events
    public function getPastEvents() {
        $query = "SELECT * FROM " . $this->table . " WHERE date_time < NOW() ORDER BY date_time DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Push event to db
    public function insertEvent($title, $description, $date_time, $location, $exp_cnt) {
        $query = "INSERT INTO " . $this->table . " 
            (title, description, date_time, location, exp_cnt) 
            VALUES (:title, :description, :date_time, :location, :exp_cnt)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date_time', $date_time);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':exp_cnt', $exp_cnt);

        return $stmt->execute();
    }
    // Update event
    public function updateEvent($id, $title, $description, $date_time, $location, $exp_cnt) {
        $query = "UPDATE " . $this->table . "
                SET title = :title,
                    description = :description,
                    date_time = :date_time,
                    location = :location,
                    exp_cnt = :exp_cnt
                WHERE event_id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date_time', $date_time);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':exp_cnt', $exp_cnt);

        return $stmt->execute();
    }

    public function deleteEvent($id) {
        $query = "DELETE FROM " . $this->table . " WHERE event_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }



}
?>
