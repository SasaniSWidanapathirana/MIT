<?php
class Event {

    private $conn;
    private $table = "contact_messages;";

    public function __construct($db) {
        $this->conn = $db;
    }

     public function getAllEvents() {
        $query = "SELECT * FROM " . $this->table . " WHERE date_time > NOW() ORDER BY date_time";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //event with partcipation
    public function getParticipatingEvents($userId) {
        $query = "
            SELECT e.*
            FROM events e
            INNER JOIN event_users eu
                ON e.event_id = eu.event_id
            WHERE eu.user_id = :user_id
            ORDER BY e.date_time ASC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    // Fetch past events
    public function getPastEvents() {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE date_time < NOW() 
                  ORDER BY date_time DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Insert new event
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

    // Delete event
    public function deleteEvent($id) {
        $query = "DELETE FROM " . $this->table . " WHERE event_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
?>