<?php
    class EventDAO{

        public function addEvent($username, $title, $start_point, $end_point, 
        $event_datetime, $event_desc, $capacity, $activity, $duration, $distance) {

            if (empty($title)) {
                $title = "RunCycle Event!";
            }

            if (empty($event_desc)) {
                $event_desc = "No Description";
            }

            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();

            $sql = "INSERT INTO `event` 
            (`username`, `title`, `start_point`, `end_point`, `event_datetime` , `event_desc`, `capacity`, `activity`, `duration`, `distance`) 
            VALUES 
            (:username, :title, :start_point, :end_point, :event_datetime , :event_desc, :capacity, :activity, :duration, :distance)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':start_point', $start_point, PDO::PARAM_STR);
            $stmt->bindParam(':end_point', $end_point, PDO::PARAM_STR);
            $stmt->bindParam(':event_datetime', $event_datetime, PDO::PARAM_STR);
            $stmt->bindParam(':event_desc', $event_desc, PDO::PARAM_STR);
            $stmt->bindParam(':capacity', $capacity, PDO::PARAM_STR);
            $stmt->bindParam(':activity', $activity, PDO::PARAM_STR);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
            $stmt->bindParam(':distance', $distance, PDO::PARAM_STR);



            $isOk = $stmt->execute();
     
            $stmt = null;
            $pdo = null;
        
            return $isOk;
        }


        public function getEvent($event_id) {
            $sql = "SELECT * FROM event where event_id = :event_id";
        
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
        
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);


            while($row = $stmt->fetch()) {
                return new Event($row['event_id'], $row['username'], $row['title'], $row['start_point'], $row['end_point'],
                $row['event_datetime'], $row['event_desc'], $row['capacity'], $row['activity'],$row['duration'], $row['distance']);
            }
        
            // (:username, :title, :start_point, :end_point, :event_datetime , :event_desc, :participants, :capacity)
            $stmt = null;
            $conn = null;
        
            return null;
        }

        public function getNewestEvent() {
            $sql = "select * from event order by event_id desc limit 1";
        
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
        
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);


            while($row = $stmt->fetch()) {
                return new Event($row['event_id'], $row['username'], $row['title'], $row['start_point'], $row['end_point'],
                $row['event_datetime'], $row['event_desc'], $row['capacity'], $row['activity'],$row['duration'], $row['distance']);
            }
        
            // (:username, :title, :start_point, :end_point, :event_datetime , :event_desc, :participants, :capacity)
            $stmt = null;
            $conn = null;
        
            return null;
        }

        public function cancelEvent($event_id) {
            $sql = "delete from participants where event_id = :event_id;
            delete from event where event_id = :event_id;";

            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
        
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $isOk = $stmt->execute();
     
            $stmt = null;
            $pdo = null;
        
            return $isOk;
        }

    }
?>